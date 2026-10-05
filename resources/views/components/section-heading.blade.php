@props(['eyebrow', 'title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'reveal max-w-2xl']) }}>
    <p class="mb-3 inline-flex items-center gap-2 font-mono text-xs uppercase tracking-[0.2em] text-violet-500 dark:text-violet-400">
        <span class="h-px w-6 bg-gradient-to-r from-violet-500 to-transparent"></span>
        {{ $eyebrow }}
    </p>
    <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ $title }}</h2>
    @if ($subtitle)
        <p class="mt-4 text-pretty text-muted">{{ $subtitle }}</p>
    @endif
</div>
