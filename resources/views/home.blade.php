<x-layout>
    {{-- Hero --}}
    <section id="inicio" class="relative mx-auto max-w-6xl px-4 pb-20 pt-32 sm:px-6 sm:pt-40 lg:pb-28">
        <div class="grid items-center gap-14 lg:grid-cols-[1.15fr_0.85fr]">
            <div>
                <a href="{{ $profile['github'] }}?tab=repositories" target="_blank" rel="noopener" class="reveal glass inline-flex items-center gap-2.5 rounded-full py-1.5 pl-2 pr-4 text-xs text-muted transition hover:text-fg">
                    <span class="relative flex size-2.5 ml-1">
                        <span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                        <span class="relative inline-flex size-2.5 rounded-full bg-emerald-400"></span>
                    </span>
                    {{ $profile['public_repos'] }} repositórios públicos em <span class="font-mono text-fg">{{ '@'.$profile['username'] }}</span>
                    <x-icon name="arrow-up-right" class="size-3.5" />
                </a>

                <h1 class="reveal mt-7 text-balance text-5xl font-semibold leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl" style="--delay: 80ms">
                    Olá, eu sou<br>
                    <span class="text-gradient">{{ $profile['short_name'] }}</span>
                </h1>

                <p class="reveal mt-6 font-mono text-sm text-violet-600 dark:text-violet-300" style="--delay: 160ms">
                    &lt;{{ $profile['role'] }} /&gt;
                </p>

                <p class="reveal mt-4 max-w-xl text-pretty text-lg text-muted" style="--delay: 220ms">
                    {{ $profile['headline'] }}
                </p>

                <div class="reveal mt-9 flex flex-wrap items-center gap-3" style="--delay: 300ms">
                    <a href="#projetos" class="btn-primary group inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-medium text-white">
                        Ver projetos
                        <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-0.5" />
                    </a>
                    <a href="{{ $profile['github'] }}" target="_blank" rel="noopener" class="glass inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-medium transition hover:border-line-strong">
                        <x-icon name="github" class="size-4" />
                        Perfil no GitHub
                    </a>
                </div>

                <div class="reveal mt-12 flex items-center gap-4" style="--delay: 380ms">
                    <span class="font-mono text-xs uppercase tracking-widest text-subtle">Stack</span>
                    <span class="h-px w-8 bg-line-strong"></span>
                    <div class="flex flex-wrap items-center gap-3">
                        @foreach (['PHP', 'Laravel', 'C#', 'Java', 'Python', 'Kotlin', 'TypeScript'] as $tech)
                            <img src="{{ asset('images/tech/'.$techIcons[$tech]) }}" alt="{{ $tech }}" title="{{ $tech }}" class="size-6 opacity-80 transition hover:-translate-y-0.5 hover:opacity-100" width="24" height="24">
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Terminal --}}
            <div class="reveal relative" style="--delay: 200ms">
                <div class="absolute -inset-2 -z-10 rounded-[2rem] sm:-inset-6 bg-gradient-to-br from-violet-600/25 via-fuchsia-500/10 to-cyan-400/25 blur-2xl"></div>

                <img src="{{ $profile['avatar'] }}" alt="Foto de {{ $profile['name'] }}" width="96" height="96"
                     class="absolute -right-3 -top-10 z-10 size-24 rounded-2xl border-4 border-page bg-card-strong object-cover shadow-2xl ring-2 ring-violet-500/60 sm:-right-6 floaty"
                     onerror="this.remove()">

                <div class="overflow-hidden rounded-2xl border border-line bg-card-strong/90 shadow-2xl shadow-black/20 backdrop-blur-xl">
                    <div class="flex items-center gap-2 border-b border-line px-4 py-3">
                        <span class="size-3 rounded-full bg-[#ff5f57]"></span>
                        <span class="size-3 rounded-full bg-[#febc2e]"></span>
                        <span class="size-3 rounded-full bg-[#28c840]"></span>
                        <span class="ml-3 font-mono text-xs text-subtle">~/portfolio — zsh</span>
                    </div>

                    @php
                        $about = [
                            'Nome' => $profile['name'],
                            'GitHub' => '@'.$profile['username'],
                            'Foco' => 'APIs REST · Web · Back-end',
                            'Stack' => 'PHP · Laravel · C# · Java',
                            'Repositórios' => $profile['public_repos'].' públicos',
                            'Desde' => substr($profile['github_since'], 0, 4),
                        ];
                    @endphp

                    <div class="space-y-1.5 p-5 font-mono text-[13px] leading-relaxed sm:p-6">
                        <p class="terminal-line" style="--i: 0">
                            <span class="text-emerald-500 dark:text-emerald-400">caio@github</span><span class="text-subtle">:</span><span class="text-cyan-600 dark:text-cyan-400">~</span><span class="text-subtle">$</span>
                            php artisan portfolio:about
                        </p>
                        <p class="terminal-line pt-3 text-emerald-600 dark:text-emerald-400" style="--i: 1">
                            <span class="font-semibold">Perfil</span>
                        </p>
                        @foreach ($about as $key => $value)
                            <p class="terminal-line flex items-baseline gap-2" style="--i: {{ $loop->iteration + 1 }}">
                                <span class="text-muted">{{ $key }}</span>
                                <span class="flex-1 translate-y-[-3px] border-b border-dotted border-line-strong"></span>
                                <span class="text-right text-fg">{{ $value }}</span>
                            </p>
                        @endforeach
                        <p class="terminal-line pt-3" style="--i: {{ count($about) + 2 }}">
                            <span class="text-emerald-500 dark:text-emerald-400">caio@github</span><span class="text-subtle">:</span><span class="text-cyan-600 dark:text-cyan-400">~</span><span class="text-subtle">$</span>
                            <span class="cursor-blink ml-1 inline-block h-4 w-2 translate-y-0.5 bg-violet-500"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Números --}}
        <dl class="mt-20 grid grid-cols-2 gap-3 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="reveal spotlight rounded-2xl border border-line bg-card p-5 backdrop-blur-sm" style="--delay: {{ $loop->index * 80 }}ms">
                    <dt class="text-sm text-muted">{{ $stat['label'] }}</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight sm:text-4xl">
                        <span class="text-gradient" @if ($stat['value'] < 1000) data-count="{{ $stat['value'] }}" @endif>{{ $stat['value'] }}</span>
                    </dd>
                </div>
            @endforeach
        </dl>
    </section>

    {{-- Sobre --}}
    <section id="sobre" class="mx-auto max-w-6xl px-4 py-24 sm:px-6">
        <div class="grid gap-14 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Sobre mim" title="Código organizado, regras claras e testes." />
                <div class="mt-6 space-y-4 text-pretty text-muted">
                    @foreach ($profile['about'] as $paragraph)
                        <p class="reveal" style="--delay: {{ $loop->index * 80 }}ms">{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                @foreach ($focus as $item)
                    <div class="reveal spotlight rounded-2xl border border-line bg-card p-6 backdrop-blur-sm transition hover:border-line-strong" style="--delay: {{ $loop->index * 80 }}ms">
                        <div class="mb-4 grid size-11 place-items-center rounded-xl bg-gradient-to-br from-violet-500/15 to-cyan-400/15 text-violet-600 ring-1 ring-inset ring-violet-500/20 dark:text-violet-300">
                            <x-icon :name="$item['icon']" class="size-5" />
                        </div>
                        <h3 class="font-semibold tracking-tight">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stack --}}
    <section id="stack" class="mx-auto max-w-6xl px-4 py-24 sm:px-6">
        <x-section-heading
            eyebrow="Stack"
            title="Tecnologias que aparecem nos meus repositórios"
            subtitle="Tudo aqui foi usado em pelo menos um projeto público — da API em Laravel ao app Android em Kotlin."
        />

        <div class="mt-12 grid gap-4 lg:grid-cols-2">
            @foreach ($skills as $group => $items)
                <div class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm" style="--delay: {{ $loop->index * 80 }}ms">
                    <h3 class="mb-4 font-mono text-xs uppercase tracking-widest text-subtle">{{ $group }}</h3>
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($items as $tech)
                            <li class="inline-flex items-center gap-2 rounded-xl border border-line bg-page/40 px-3 py-2 text-sm transition hover:-translate-y-0.5 hover:border-line-strong">
                                @isset($techIcons[$tech])
                                    <img src="{{ asset('images/tech/'.$techIcons[$tech]) }}" alt="" class="size-4 {{ match (true) { $tech === 'Next.js' => 'dark:invert', in_array($tech, ['Express', 'Django', 'MySQL']) => 'dark:brightness-0 dark:invert', default => '' } }}" loading="lazy" width="16" height="16">
                                @else
                                    <span class="size-1.5 rounded-full bg-gradient-to-br from-violet-400 to-cyan-400"></span>
                                @endisset
                                {{ $tech }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-4 grid gap-4 lg:grid-cols-[1fr_1.2fr]">
            {{-- Linguagens --}}
            <div class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm">
                <h3 class="font-mono text-xs uppercase tracking-widest text-subtle">Linguagens nos projetos</h3>
                <div class="mt-5 flex h-3 overflow-hidden rounded-full bg-page/60" role="img" aria-label="Distribuição de linguagens nos projetos">
                    @foreach ($languages as $language)
                        <span class="lang-bar h-full first:rounded-l-full last:rounded-r-full" style="width: {{ $language['percent'] }}%; background: {{ $language['color'] }}; --delay: {{ $loop->index * 90 }}ms"></span>
                    @endforeach
                </div>
                <ul class="mt-5 grid grid-cols-2 gap-x-4 gap-y-2.5 text-sm">
                    @foreach ($languages as $language)
                        <li class="flex items-center gap-2">
                            <span class="size-2.5 rounded-full" style="background: {{ $language['color'] }}"></span>
                            <span>{{ $language['name'] }}</span>
                            <span class="ml-auto font-mono text-xs text-subtle">{{ $language['count'] }} · {{ $language['percent'] }}%</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-5 text-sm text-subtle">Linguagem principal de cada um dos {{ $projects->count() }} projetos listados abaixo.</p>
            </div>

            {{-- Padrões --}}
            <div class="reveal rounded-2xl border border-line bg-card p-6 backdrop-blur-sm" style="--delay: 80ms">
                <h3 class="font-mono text-xs uppercase tracking-widest text-subtle">Padrões de projeto aplicados</h3>
                <ul class="mt-5 flex flex-wrap gap-2">
                    @foreach ($patterns as $pattern)
                        <li>
                            <a href="{{ $profile['github'] }}/{{ $pattern['repos'][0] }}" target="_blank" rel="noopener"
                               title="Repositórios: {{ implode(', ', $pattern['repos']) }}"
                               class="group inline-flex items-center gap-2 rounded-xl border border-line px-3 py-2 text-sm transition hover:border-violet-500/50 hover:bg-violet-500/5">
                                {{ $pattern['name'] }}
                                <span class="rounded-md bg-page/60 px-1.5 font-mono text-[11px] text-subtle group-hover:text-violet-500">{{ count($pattern['repos']) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-5 text-sm text-subtle">O número indica em quantos repositórios cada padrão aparece.</p>
            </div>
        </div>
    </section>

    {{-- Projetos --}}
    <section id="projetos" class="mx-auto max-w-6xl px-4 py-24 sm:px-6">
        <x-section-heading
            eyebrow="Projetos"
            title="Em destaque"
            subtitle="Os projetos mais completos do meu GitHub, com arquitetura, regras de negócio e testes documentados."
        />

        <div class="mt-12 grid gap-4 lg:grid-cols-2">
            @foreach ($featured as $project)
                <article class="spotlight reveal group relative flex flex-col overflow-hidden rounded-3xl border border-line bg-card p-7 backdrop-blur-sm transition duration-300 hover:border-line-strong sm:p-8 {{ $loop->first ? 'lg:row-span-2' : '' }}" style="--delay: {{ $loop->index * 100 }}ms">
                    <div class="pointer-events-none absolute -right-24 -top-24 size-64 rounded-full opacity-20 blur-3xl transition group-hover:opacity-40" style="background: {{ $project['color'] }}"></div>

                    <div class="flex flex-wrap items-center gap-2 text-xs">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-500/10 px-2.5 py-1 font-medium text-violet-600 dark:text-violet-300">
                            <x-icon name="sparkles" class="size-3.5" /> Destaque
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-line px-2.5 py-1 text-muted">
                            <span class="size-2 rounded-full" style="background: {{ $project['color'] }}"></span>{{ $project['language'] }}
                        </span>
                        @if ($project['stars'])
                            <span class="inline-flex items-center gap-1 text-subtle"><x-icon name="star" class="size-3.5" />{{ $project['stars'] }}</span>
                        @endif
                        @if ($project['forks'])
                            <span class="inline-flex items-center gap-1 text-subtle"><x-icon name="fork" class="size-3.5" />{{ $project['forks'] }}</span>
                        @endif
                        <span class="ml-auto font-mono text-subtle">{{ $project['date_label'] }}</span>
                    </div>

                    <h3 class="mt-5 text-2xl font-semibold tracking-tight sm:text-3xl">{{ $project['name'] }}</h3>
                    <p class="mt-3 text-pretty text-muted">{{ $project['summary'] }}</p>

                    <ul class="mt-6 space-y-2.5 text-sm">
                        @foreach ($loop->first ? $project['highlights'] : array_slice($project['highlights'], 0, 3) as $highlight)
                            <li class="flex gap-3">
                                <x-icon name="check" class="mt-0.5 size-4 shrink-0 text-emerald-500" />
                                <span class="text-muted">{{ $highlight }}</span>
                            </li>
                        @endforeach
                    </ul>

                    @if ($loop->first && $project['flow'])
                        <div class="mt-8 rounded-2xl border border-line bg-page/40 p-4">
                            <p class="mb-3 font-mono text-[11px] uppercase tracking-widest text-subtle">{{ $project['flow_title'] }}</p>
                            <ol class="flex flex-wrap items-center gap-1.5 font-mono text-[11px]">
                                @foreach ($project['flow'] as [$layer])
                                    <li class="flex items-center gap-1.5">
                                        <span class="rounded-md border border-line bg-card px-2 py-1 text-fg [overflow-wrap:anywhere]">{{ $layer }}</span>
                                        @unless ($loop->last)
                                            <x-icon name="arrow-right" class="size-3 text-violet-500" />
                                        @endunless
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endif

                    <div class="mt-auto pt-8">
                        <ul class="flex flex-wrap gap-1.5">
                            @foreach ($project['stack'] as $tech)
                                <li class="rounded-md border border-line bg-page/40 px-2 py-0.5 font-mono text-[11px] text-muted">{{ $tech }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <a href="{{ route('projects.show', $project['slug']) }}" class="btn-primary group/btn inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium text-white">
                                Ver detalhes <x-icon name="arrow-right" class="size-4 transition group-hover/btn:translate-x-0.5" />
                            </a>
                            <a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl border border-line px-4 py-2.5 text-sm font-medium transition hover:border-line-strong">
                                <x-icon name="github" class="size-4" /> Código
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Todos os projetos --}}
        <div class="mt-24 flex flex-col gap-8">
            <x-section-heading eyebrow="Arquivo" title="Todos os projetos" subtitle="Filtre por tecnologia — cada card leva aos detalhes e ao repositório." />
            <div class="reveal flex flex-wrap gap-2" role="group" aria-label="Filtrar projetos por tecnologia">
                <button type="button" data-filter="all" aria-pressed="true" class="filter-chip">
                    Todos <span>{{ $projects->count() }}</span>
                </button>
                @foreach ($categories as $category)
                    <button type="button" data-filter="{{ $category['key'] }}" aria-pressed="false" class="filter-chip">
                        {{ $category['label'] }} <span>{{ $category['count'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3" data-project-grid>
            @foreach ($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
    </section>

    {{-- Trajetória --}}
    <section id="trajetoria" class="mx-auto grid max-w-6xl gap-14 px-4 py-24 sm:px-6 lg:grid-cols-[0.8fr_1.2fr]">
        <div class="lg:sticky lg:top-32 lg:self-start">
            <x-section-heading
                eyebrow="Trajetória"
                title="A evolução contada pelos commits"
                subtitle="Uma linha do tempo montada a partir das datas de criação dos repositórios — de abril de 2025 até hoje."
            />
        </div>

        <ol class="relative">
            <span class="absolute bottom-2 left-[7px] top-2 w-px bg-gradient-to-b from-violet-500 via-fuchsia-500/60 to-cyan-400/20" aria-hidden="true"></span>
            @foreach ($timeline as $item)
                <li class="reveal relative pb-12 pl-10 last:pb-0" style="--delay: {{ $loop->index * 40 }}ms">
                    <span class="absolute left-0 top-1.5 grid size-[15px] place-items-center rounded-full border border-violet-500/60 bg-page" aria-hidden="true">
                        <span class="size-[7px] rounded-full bg-gradient-to-br from-violet-400 to-cyan-300"></span>
                    </span>
                    <time datetime="{{ $item['date'] }}" class="font-mono text-xs uppercase tracking-widest text-violet-600 dark:text-violet-300">{{ $item['date_label'] }}</time>
                    <h3 class="mt-1.5 text-lg font-semibold tracking-tight">{{ $item['title'] }}</h3>
                    <p class="mt-1.5 text-pretty text-muted">{{ $item['text'] }}</p>
                    <ul class="mt-3 flex flex-wrap gap-1.5">
                        @foreach ($item['repos'] as $repo)
                            <li>
                                <a href="{{ $profile['github'] }}/{{ $repo }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 rounded-md border border-line px-2 py-0.5 font-mono text-[11px] text-muted transition hover:border-violet-500/50 hover:text-fg">
                                    {{ $repo }} <x-icon name="arrow-up-right" class="size-3" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Contato --}}
    <section id="contato" class="mx-auto max-w-6xl px-4 pb-28 pt-12 sm:px-6">
        <div class="reveal gradient-border relative overflow-hidden rounded-3xl p-10 text-center sm:p-16">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-violet-600/15 via-transparent to-cyan-400/15"></div>
            <div class="relative">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-violet-600 dark:text-violet-300">Contato</p>
                <h2 class="mx-auto mt-4 max-w-2xl text-balance text-3xl font-semibold tracking-tight sm:text-5xl">
                    Vamos construir <span class="text-gradient">algo juntos?</span>
                </h2>
                <p class="mx-auto mt-5 max-w-xl text-pretty text-muted">
                    Meu código está todo aberto. Explore os repositórios, abra uma issue ou me siga no GitHub para acompanhar os próximos projetos.
                </p>
                <div class="mt-9 flex flex-wrap justify-center gap-3">
                    <a href="{{ $profile['github'] }}" target="_blank" rel="noopener" class="btn-primary group inline-flex items-center gap-2 rounded-xl px-6 py-3.5 text-sm font-medium text-white">
                        <x-icon name="github" class="size-4" />
                        github.com/{{ $profile['username'] }}
                    </a>
                    <a href="{{ $profile['github'] }}?tab=repositories" target="_blank" rel="noopener" class="glass inline-flex items-center gap-2 rounded-xl px-6 py-3.5 text-sm font-medium transition hover:border-line-strong">
                        Ver repositórios <x-icon name="arrow-up-right" class="size-4" />
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
