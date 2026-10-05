<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PortfolioService
{
    public function profile(): array
    {
        return config('portfolio.profile');
    }

    public function projects(): Collection
    {
        return $this->all()->sortByDesc('date')->values();
    }

    /**
     * Projetos em destaque, na ordem em que aparecem no config.
     */
    public function featured(): Collection
    {
        return $this->all()->where('featured', true)->values();
    }

    public function find(string $slug): ?array
    {
        return $this->projects()->firstWhere('slug', $slug);
    }

    /**
     * Projeto anterior e próximo na ordem da listagem, para navegação na página de detalhes.
     */
    public function neighbors(string $slug): array
    {
        $projects = $this->projects();
        $index = $projects->search(fn (array $project) => $project['slug'] === $slug);

        return [
            'previous' => $index > 0 ? $projects[$index - 1] : null,
            'next' => $projects[$index + 1] ?? null,
        ];
    }

    /**
     * Distribuição das linguagens principais dos projetos, em percentual.
     */
    public function languageBreakdown(): Collection
    {
        $projects = $this->projects();
        $colors = config('portfolio.languages');

        return $projects
            ->countBy('language')
            ->sortDesc()
            ->map(fn (int $count, string $language) => [
                'name' => $language,
                'count' => $count,
                'percent' => round($count / $projects->count() * 100, 1),
                'color' => $colors[$language] ?? '#8b949e',
            ])
            ->values();
    }

    /**
     * Categorias de filtro que possuem ao menos um projeto, com a contagem de cada uma.
     */
    public function categories(): Collection
    {
        $counts = $this->projects()->countBy('category');

        return collect(config('portfolio.categories'))
            ->filter(fn (string $label, string $key) => $counts->has($key))
            ->map(fn (string $label, string $key) => ['key' => $key, 'label' => $label, 'count' => $counts[$key]]);
    }

    public function timeline(): Collection
    {
        return collect(config('portfolio.timeline'))
            ->map(fn (array $item) => $item + ['date_label' => $this->monthLabel($item['date'])]);
    }

    public function stats(): array
    {
        $profile = $this->profile();

        return [
            ['value' => $profile['public_repos'], 'label' => 'repositórios públicos'],
            ['value' => $this->projects()->pluck('language')->unique()->count(), 'label' => 'linguagens'],
            ['value' => count(config('portfolio.patterns')), 'label' => 'padrões aplicados'],
            ['value' => substr($profile['github_since'], 0, 4), 'label' => 'no GitHub desde'],
        ];
    }

    public function repoUrl(string $repo): string
    {
        return rtrim($this->profile()['github'], '/').'/'.$repo;
    }

    private function all(): Collection
    {
        return collect(config('portfolio.projects'))->map(fn (array $project) => $this->withDefaults($project));
    }

    private function withDefaults(array $project): array
    {
        return $project + [
            'featured' => false,
            'team' => false,
            'stars' => 0,
            'forks' => 0,
            'highlights' => [],
            'endpoints' => [],
            'flow' => [],
            'url' => $this->repoUrl($project['repo']),
            'color' => config('portfolio.languages')[$project['language']] ?? '#8b949e',
            'date_label' => $this->monthLabel($project['date']),
        ];
    }

    /**
     * Converte "2025-06" em "jun 2025".
     */
    private function monthLabel(string $date): string
    {
        return Carbon::createFromFormat('!Y-m', $date)->locale('pt_BR')->translatedFormat('M Y');
    }
}
