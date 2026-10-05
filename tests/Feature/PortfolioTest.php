<?php

namespace Tests\Feature;

use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    public function test_home_page_renders_profile_and_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Caio Marcidele')
            ->assertSee('id="sobre"', false)
            ->assertSee('id="stack"', false)
            ->assertSee('id="projetos"', false)
            ->assertSee('id="trajetoria"', false)
            ->assertSee('id="contato"', false)
            ->assertSee('https://github.com/Mrcidele', false);
    }

    public function test_home_page_lists_every_project(): void
    {
        $response = $this->get('/');

        foreach (config('portfolio.projects') as $project) {
            $response->assertSee($project['name']);
            $response->assertSee(route('projects.show', $project['slug']), false);
        }
    }

    public function test_project_page_shows_details(): void
    {
        $this->get('/projetos/api-delivery-laravel')
            ->assertOk()
            ->assertSee('API Delivery de Comida')
            ->assertSee('/pedidos/{id}/status')
            ->assertSee('https://github.com/Mrcidele/delivery_api_facul', false);
    }

    public function test_every_project_page_is_reachable(): void
    {
        foreach (config('portfolio.projects') as $project) {
            $this->get(route('projects.show', $project['slug']))->assertOk();
        }
    }

    public function test_unknown_project_returns_404(): void
    {
        $this->get('/projetos/nao-existe')
            ->assertNotFound()
            ->assertSee('Página não encontrada');
    }

    public function test_project_slugs_are_unique_and_complete(): void
    {
        $projects = collect(config('portfolio.projects'));
        $required = ['slug', 'name', 'repo', 'language', 'category', 'date', 'summary', 'description', 'stack'];

        $this->assertSame($projects->count(), $projects->pluck('slug')->unique()->count());

        foreach ($projects as $project) {
            foreach ($required as $key) {
                $this->assertNotEmpty($project[$key] ?? null, "Projeto {$project['slug']} sem o campo {$key}");
            }

            $this->assertArrayHasKey($project['category'], config('portfolio.categories'));
            $this->assertArrayHasKey($project['language'], config('portfolio.languages'));
        }
    }

    public function test_export_generates_static_site(): void
    {
        $output = storage_path('framework/testing/export');

        $this->artisan('portfolio:export', ['--output' => $output, '--base-url' => 'https://exemplo.test/portfolio'])
            ->assertSuccessful();

        $this->assertFileExists("{$output}/index.html");
        $this->assertFileExists("{$output}/404.html");
        $this->assertFileExists("{$output}/favicon.svg");
        $this->assertFileExists("{$output}/build/manifest.json");
        $this->assertFileDoesNotExist("{$output}/index.php");

        foreach (config('portfolio.projects') as $project) {
            $this->assertFileExists("{$output}/projetos/{$project['slug']}/index.html");
        }

        $home = file_get_contents("{$output}/index.html");
        $this->assertStringContainsString('https://exemplo.test/portfolio/projetos/api-delivery-laravel', $home);
        $this->assertStringContainsString('https://exemplo.test/portfolio/build/assets/', $home);

        (new Filesystem)->deleteDirectory($output);
    }
}
