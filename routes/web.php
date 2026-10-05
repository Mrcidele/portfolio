<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projetos/{slug}', [PortfolioController::class, 'show'])->name('projects.show');
