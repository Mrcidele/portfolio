@props([
    'title' => null,
    'description' => null,
])

@php
    $profile = config('portfolio.profile');
    $pageTitle = $title ? "{$title} · {$profile['short_name']}" : "{$profile['short_name']} · Portfólio";
    $pageDescription = $description ?? $profile['headline'];
    $nav = [
        'sobre' => 'Sobre',
        'stack' => 'Stack',
        'projetos' => 'Projetos',
        'trajetoria' => 'Trajetória',
        'contato' => 'Contato',
    ];
@endphp

<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="author" content="{{ $profile['name'] }}">
    <meta name="theme-color" content="#07070c">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $profile['avatar'] }}">
    <meta name="twitter:card" content="summary">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|jetbrains-mono:400,500" rel="stylesheet">

    {{-- Aplica o tema salvo antes da renderização para evitar flash de cor. --}}
    <script>
        (function () {
            var root = document.documentElement;
            root.classList.add('js');
            try {
                var theme = localStorage.getItem('theme');
                if (theme === 'light') root.classList.remove('dark');
            } catch (e) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-clip bg-page font-sans text-fg antialiased selection:bg-violet-500/30">
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-violet-600 focus:px-4 focus:py-2 focus:text-white">
        Pular para o conteúdo
    </a>

    {{-- Fundo decorativo --}}
    <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="bg-grid absolute inset-0"></div>
        <div class="blob left-[-10%] top-[-10%] size-[38rem] bg-violet-600"></div>
        <div class="blob right-[-15%] top-[10%] size-[32rem] bg-cyan-500 [animation-delay:-6s]"></div>
        <div class="blob bottom-[-20%] left-[25%] size-[30rem] bg-fuchsia-600 [animation-delay:-12s]"></div>
        <div class="noise absolute inset-0"></div>
    </div>

    {{-- Navegação --}}
    <header data-header class="fixed inset-x-0 top-0 z-50 px-4 pt-4 transition-all duration-300">
        <nav class="glass mx-auto flex max-w-6xl items-center justify-between gap-4 rounded-2xl px-4 py-2.5 shadow-lg shadow-black/5" aria-label="Principal">
            <a href="{{ route('home') }}" class="group flex items-center gap-2.5">
                <span class="grid size-9 place-items-center rounded-xl bg-gradient-to-br from-violet-500 via-fuchsia-500 to-cyan-400 font-mono text-sm font-semibold text-white shadow-lg shadow-violet-500/30 transition group-hover:rotate-6">CM</span>
                <span class="hidden font-medium tracking-tight sm:block">{{ $profile['short_name'] }}</span>
            </a>

            <ul class="hidden items-center gap-1 md:flex">
                @foreach ($nav as $anchor => $label)
                    <li>
                        <a href="{{ route('home') }}#{{ $anchor }}" data-nav-link="{{ $anchor }}" class="nav-link rounded-lg px-3 py-2 text-sm text-muted transition hover:text-fg">{{ $label }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="flex items-center gap-2">
                <button type="button" data-theme-toggle class="grid size-9 place-items-center rounded-xl border border-line text-muted transition hover:border-line-strong hover:text-fg" aria-label="Alternar tema claro/escuro">
                    <x-icon name="sun" class="hidden size-4 dark:block" />
                    <x-icon name="moon" class="size-4 dark:hidden" />
                </button>
                <a href="{{ $profile['github'] }}" target="_blank" rel="noopener" class="hidden items-center gap-2 rounded-xl bg-fg px-3.5 py-2 text-sm font-medium text-page transition hover:opacity-90 sm:inline-flex">
                    <x-icon name="github" class="size-4" />
                    GitHub
                </a>
                <button type="button" data-menu-toggle class="grid size-9 place-items-center rounded-xl border border-line text-muted md:hidden" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu-mobile">
                    <x-icon name="menu" class="size-4" data-menu-open />
                    <x-icon name="x" class="hidden size-4" data-menu-close />
                </button>
            </div>
        </nav>

        <div id="menu-mobile" data-menu class="glass mx-auto mt-2 hidden max-w-6xl rounded-2xl p-2 md:hidden">
            @foreach ($nav as $anchor => $label)
                <a href="{{ route('home') }}#{{ $anchor }}" class="block rounded-xl px-4 py-3 text-sm text-muted transition hover:bg-card hover:text-fg">{{ $label }}</a>
            @endforeach
            <a href="{{ $profile['github'] }}" target="_blank" rel="noopener" class="mt-1 flex items-center gap-2 rounded-xl px-4 py-3 text-sm font-medium">
                <x-icon name="github" class="size-4" /> github.com/{{ $profile['username'] }}
            </a>
        </div>
    </header>

    <main id="conteudo">
        {{ $slot }}
    </main>

    <footer class="border-t border-line">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-4 py-10 text-sm text-subtle sm:flex-row sm:px-6">
            <p>&copy; {{ date('Y') }} {{ $profile['name'] }}</p>
            <p>Feito com <span class="font-medium text-muted">Laravel {{ app()->version() }}</span>, Blade e Tailwind CSS</p>
            <a href="{{ $profile['github'] }}/portfolio" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 transition hover:text-fg">
                <x-icon name="code" class="size-4" /> Código-fonte
            </a>
        </div>
    </footer>
</body>
</html>
