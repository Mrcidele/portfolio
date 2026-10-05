<?php

namespace App\Console\Commands;

use App\Services\PortfolioService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use RuntimeException;

#[Signature('portfolio:export
    {--output=dist : Pasta onde o site estático será gerado}
    {--base-url= : URL pública do site, ex.: https://mrcidele.github.io/portfolio}')]
#[Description('Gera o portfólio como site estático (HTML + assets) para o GitHub Pages')]
class ExportStaticSite extends Command
{
    /**
     * Arquivos de public/ que só fazem sentido com PHP rodando.
     */
    private const SKIP = ['index.php', '.htaccess', 'hot'];

    public function handle(PortfolioService $portfolio, Filesystem $files): int
    {
        $output = rtrim($this->option('output'), '/');
        $baseUrl = rtrim($this->option('base-url') ?: config('app.url'), '/');

        if (! $files->exists(public_path('build/manifest.json'))) {
            $this->error('Assets não encontrados. Rode "npm run build" antes de exportar.');

            return self::FAILURE;
        }

        URL::forceRootUrl($baseUrl);
        URL::forceScheme(parse_url($baseUrl, PHP_URL_SCHEME) ?: 'https');

        $files->deleteDirectory($output);
        $files->ensureDirectoryExists($output);

        $pages = ['/' => 'index.html'];

        foreach ($portfolio->projects() as $project) {
            $pages["/projetos/{$project['slug']}"] = "projetos/{$project['slug']}/index.html";
        }

        foreach ($pages as $uri => $file) {
            $this->write($files, "{$output}/{$file}", $this->render($uri, 200));
        }

        // O GitHub Pages usa 404.html para qualquer rota inexistente.
        $this->write($files, "{$output}/404.html", $this->render('/__pagina-inexistente__', 404));

        foreach ($files->allFiles(public_path(), true) as $asset) {
            if (! in_array($asset->getRelativePathname(), self::SKIP, true)) {
                $files->ensureDirectoryExists("{$output}/{$asset->getRelativePath()}");
                $files->copy($asset->getPathname(), "{$output}/{$asset->getRelativePathname()}");
            }
        }

        $this->components->info(count($pages).' páginas + 404 geradas em '.$output.' para '.$baseUrl);

        return self::SUCCESS;
    }

    private function render(string $uri, int $expectedStatus): string
    {
        $kernel = $this->laravel->make(Kernel::class);
        $request = Request::create($uri);
        $response = $kernel->handle($request);
        $kernel->terminate($request, $response);

        if ($response->getStatusCode() !== $expectedStatus) {
            throw new RuntimeException("{$uri} retornou {$response->getStatusCode()}, esperado {$expectedStatus}.");
        }

        return $response->getContent();
    }

    private function write(Filesystem $files, string $path, string $contents): void
    {
        $files->ensureDirectoryExists(dirname($path));
        $files->put($path, $contents);
    }
}
