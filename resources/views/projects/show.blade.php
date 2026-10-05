<x-layout :title="$project['name']" :description="$project['summary']">
    <article class="mx-auto max-w-6xl px-4 pb-24 pt-32 sm:px-6 sm:pt-40">
        <a href="{{ route('home') }}#projetos" class="reveal group inline-flex items-center gap-2 text-sm text-muted transition hover:text-fg">
            <x-icon name="arrow-left" class="size-4 transition group-hover:-translate-x-0.5" />
            Voltar para projetos
        </a>

        {{-- Cabeçalho --}}
        <header class="relative mt-8">
            <div class="pointer-events-none absolute -left-20 -top-20 -z-10 size-80 rounded-full opacity-20 blur-3xl" style="background: {{ $project['color'] }}"></div>

            <div class="reveal flex flex-wrap items-center gap-2 text-xs">
                <span class="inline-flex items-center gap-1.5 rounded-full border border-line px-2.5 py-1 text-muted">
                    <span class="size-2 rounded-full" style="background: {{ $project['color'] }}"></span>{{ $project['language'] }}
                </span>
                <span class="rounded-full border border-line px-2.5 py-1 text-muted">{{ config('portfolio.categories')[$project['category']] }}</span>
                @if ($project['featured'])
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-500/10 px-2.5 py-1 font-medium text-violet-600 dark:text-violet-300">
                        <x-icon name="sparkles" class="size-3.5" /> Destaque
                    </span>
                @endif
                @if ($project['team'])
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-cyan-500/10 px-2.5 py-1 font-medium text-cyan-700 dark:text-cyan-300">
                        <x-icon name="users" class="size-3.5" /> Projeto em equipe
                    </span>
                @endif
            </div>

            <h1 class="reveal mt-5 max-w-4xl text-balance text-4xl font-semibold tracking-tight sm:text-6xl" style="--delay: 60ms">{{ $project['name'] }}</h1>
            <p class="reveal mt-5 max-w-3xl text-pretty text-lg text-muted" style="--delay: 120ms">{{ $project['summary'] }}</p>

            <div class="reveal mt-8 flex flex-wrap gap-3" style="--delay: 180ms">
                <a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="btn-primary group inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-medium text-white">
                    <x-icon name="github" class="size-4" />
                    Ver código no GitHub
                    <x-icon name="arrow-up-right" class="size-4 transition group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                </a>
            </div>
        </header>

        <div class="mt-16 grid gap-6 lg:grid-cols-[1fr_320px]">
            <div class="min-w-0 space-y-6">
                {{-- Sobre o projeto --}}
                <section class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm sm:p-8">
                    <h2 class="font-mono text-xs uppercase tracking-widest text-subtle">Sobre o projeto</h2>
                    <p class="mt-4 text-pretty leading-relaxed text-muted">{{ $project['description'] }}</p>
                </section>

                {{-- Destaques --}}
                @if ($project['highlights'])
                    <section class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm sm:p-8">
                        <h2 class="font-mono text-xs uppercase tracking-widest text-subtle">Destaques</h2>
                        <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                            @foreach ($project['highlights'] as $highlight)
                                <li class="flex gap-3 rounded-xl border border-line bg-page/40 p-4 text-sm">
                                    <x-icon name="check" class="mt-0.5 size-4 shrink-0 text-emerald-500" />
                                    <span class="text-muted">{{ $highlight }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                {{-- Fluxo da arquitetura --}}
                @if ($project['flow'])
                    <section class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm sm:p-8">
                        <h2 class="font-mono text-xs uppercase tracking-widest text-subtle">{{ $project['flow_title'] }}</h2>
                        <ol class="mt-5 space-y-2">
                            @foreach ($project['flow'] as [$layer, $role])
                                <li class="flex items-center gap-4">
                                    <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-violet-500/20 to-cyan-400/20 font-mono text-xs text-violet-600 ring-1 ring-inset ring-violet-500/20 dark:text-violet-300">{{ $loop->iteration }}</span>
                                    <div class="flex min-w-0 flex-1 flex-wrap items-baseline justify-between gap-x-4 rounded-xl border border-line bg-page/40 px-4 py-3">
                                        <code class="font-mono text-sm text-fg [overflow-wrap:anywhere]">{{ $layer }}</code>
                                        <span class="text-sm text-subtle">{{ $role }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </section>
                @endif

                {{-- Endpoints --}}
                @if ($project['endpoints'])
                    <section class="reveal overflow-hidden rounded-2xl border border-line bg-card backdrop-blur-sm">
                        <h2 class="px-6 pt-6 font-mono text-xs uppercase tracking-widest text-subtle sm:px-8 sm:pt-8">{{ $project['endpoints_title'] }}</h2>
                        <ul class="mt-5 divide-y divide-line border-t border-line">
                            @foreach ($project['endpoints'] as [$method, $path, $info])
                                <li class="flex flex-wrap items-center gap-x-4 gap-y-1 px-6 py-3.5 sm:px-8">
                                    <span @class([
                                        'w-16 rounded-md px-2 py-0.5 text-center font-mono text-[11px] font-semibold',
                                        'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' => $method === 'GET',
                                        'bg-violet-500/10 text-violet-600 dark:text-violet-300' => $method === 'POST',
                                        'bg-amber-500/10 text-amber-600 dark:text-amber-400' => $method === 'PUT',
                                        'bg-rose-500/10 text-rose-600 dark:text-rose-400' => $method === 'DELETE',
                                    ])>{{ $method }}</span>
                                    <code class="font-mono text-sm text-fg [overflow-wrap:anywhere]">{{ $path }}</code>
                                    <span class="text-sm text-subtle sm:ml-auto">{{ $info }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif
            </div>

            {{-- Lateral --}}
            <aside class="space-y-6 lg:sticky lg:top-28 lg:self-start">
                <section class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm" style="--delay: 80ms">
                    <h2 class="font-mono text-xs uppercase tracking-widest text-subtle">Stack</h2>
                    <ul class="mt-4 flex flex-wrap gap-2">
                        @foreach ($project['stack'] as $tech)
                            <li class="rounded-lg border border-line bg-page/40 px-2.5 py-1 font-mono text-xs text-muted">{{ $tech }}</li>
                        @endforeach
                    </ul>
                </section>

                <section class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm" style="--delay: 140ms">
                    <h2 class="font-mono text-xs uppercase tracking-widest text-subtle">Informações</h2>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-subtle">Repositório</dt>
                            <dd><a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="font-mono text-xs text-fg underline decoration-line-strong underline-offset-4 transition hover:decoration-violet-500">{{ $project['repo'] }}</a></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-subtle">Criado em</dt>
                            <dd class="inline-flex items-center gap-1.5"><x-icon name="calendar" class="size-3.5 text-subtle" />{{ $project['date_label'] }}</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-subtle">Linguagem</dt>
                            <dd class="inline-flex items-center gap-1.5"><span class="size-2 rounded-full" style="background: {{ $project['color'] }}"></span>{{ $project['language'] }}</dd>
                        </div>
                        @if ($project['stars'] || $project['forks'])
                            <div class="flex items-center justify-between gap-4">
                                <dt class="text-subtle">GitHub</dt>
                                <dd class="inline-flex items-center gap-3">
                                    <span class="inline-flex items-center gap-1"><x-icon name="star" class="size-3.5" />{{ $project['stars'] }}</span>
                                    <span class="inline-flex items-center gap-1"><x-icon name="fork" class="size-3.5" />{{ $project['forks'] }}</span>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </section>
            </aside>
        </div>

        {{-- Navegação entre projetos --}}
        <nav class="mt-16 grid gap-4 sm:grid-cols-2" aria-label="Outros projetos">
            @if ($previous)
                <a href="{{ route('projects.show', $previous['slug']) }}" class="reveal spotlight group rounded-2xl border border-line bg-card p-6 backdrop-blur-sm transition hover:border-line-strong">
                    <span class="inline-flex items-center gap-1.5 text-xs text-subtle"><x-icon name="arrow-left" class="size-3.5 transition group-hover:-translate-x-0.5" /> Anterior</span>
                    <span class="mt-2 block font-semibold tracking-tight">{{ $previous['name'] }}</span>
                </a>
            @else
                <span class="hidden sm:block"></span>
            @endif
            @if ($next)
                <a href="{{ route('projects.show', $next['slug']) }}" class="reveal spotlight group rounded-2xl border border-line bg-card p-6 text-right backdrop-blur-sm transition hover:border-line-strong">
                    <span class="inline-flex items-center gap-1.5 text-xs text-subtle">Próximo <x-icon name="arrow-right" class="size-3.5 transition group-hover:translate-x-0.5" /></span>
                    <span class="mt-2 block font-semibold tracking-tight">{{ $next['name'] }}</span>
                </a>
            @endif
        </nav>
    </article>
</x-layout>
