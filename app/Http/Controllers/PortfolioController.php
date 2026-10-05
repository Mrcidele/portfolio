<?php

namespace App\Http\Controllers;

use App\Services\PortfolioService;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct(private PortfolioService $portfolio) {}

    public function index(): View
    {
        return view('home', [
            'profile' => $this->portfolio->profile(),
            'stats' => $this->portfolio->stats(),
            'focus' => config('portfolio.focus'),
            'skills' => config('portfolio.skills'),
            'techIcons' => config('portfolio.tech_icons'),
            'patterns' => config('portfolio.patterns'),
            'timeline' => $this->portfolio->timeline(),
            'featured' => $this->portfolio->featured(),
            'projects' => $this->portfolio->projects(),
            'categories' => $this->portfolio->categories(),
            'languages' => $this->portfolio->languageBreakdown(),
        ]);
    }

    public function show(string $slug): View
    {
        $project = $this->portfolio->find($slug);

        abort_if($project === null, 404);

        return view('projects.show', [
            'profile' => $this->portfolio->profile(),
            'project' => $project,
            ...$this->portfolio->neighbors($slug),
        ]);
    }
}
