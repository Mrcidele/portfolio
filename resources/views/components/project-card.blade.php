@props(['project'])

<article
    data-project
    data-category="{{ $project['category'] }}"
    {{ $attributes->merge(['class' => 'spotlight reveal group relative flex h-full flex-col rounded-2xl border border-line bg-card p-6 backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:border-line-strong']) }}
>
    <div class="mb-4 flex items-center justify-between gap-3 text-xs text-subtle">
        <span class="inline-flex items-center gap-2 font-medium">
            <span class="size-2.5 rounded-full" style="background: {{ $project['color'] }}"></span>
            {{ $project['language'] }}
        </span>
        <span class="inline-flex items-center gap-3 font-mono">
            @if ($project['team'])
                <span class="inline-flex items-center gap-1" title="Projeto em equipe"><x-icon name="users" class="size-3.5" /> equipe</span>
            @endif
            {{ $project['date_label'] }}
        </span>
    </div>

    <h3 class="text-lg font-semibold tracking-tight">
        <a href="{{ route('projects.show', $project['slug']) }}" class="after:absolute after:inset-0 after:rounded-2xl focus:outline-none">
            {{ $project['name'] }}
        </a>
    </h3>
    <p class="mt-2 line-clamp-3 text-sm text-muted">{{ $project['summary'] }}</p>

    <ul class="mt-5 flex flex-wrap gap-1.5">
        @foreach (array_slice($project['stack'], 0, 4) as $tech)
            <li class="rounded-md border border-line px-2 py-0.5 font-mono text-[11px] text-muted">{{ $tech }}</li>
        @endforeach
    </ul>

    <div class="mt-auto flex items-center justify-between pt-6 text-sm">
        <span class="inline-flex items-center gap-1.5 font-medium text-fg transition group-hover:gap-2.5">
            Ver detalhes <x-icon name="arrow-right" class="size-4" />
        </span>
        <a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="relative z-10 inline-flex items-center gap-1.5 rounded-lg px-2 py-1 text-subtle transition hover:bg-card hover:text-fg" aria-label="Repositório {{ $project['repo'] }} no GitHub">
            <x-icon name="github" class="size-4" />
        </a>
    </div>
</article>
