<x-layout title="Página não encontrada">
    <section class="mx-auto flex min-h-[80vh] max-w-6xl flex-col items-center justify-center px-4 pt-24 text-center sm:px-6">
        <p class="font-mono text-sm text-violet-600 dark:text-violet-300">HTTP 404</p>
        <h1 class="mt-4 text-6xl font-semibold tracking-tight sm:text-8xl"><span class="text-gradient">404</span></h1>
        <p class="mt-5 max-w-md text-pretty text-muted">Essa página não existe — talvez o projeto tenha mudado de nome. Que tal voltar para a lista?</p>
        <a href="{{ route('home') }}#projetos" class="btn-primary group mt-9 inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-medium text-white">
            <x-icon name="arrow-left" class="size-4 transition group-hover:-translate-x-0.5" />
            Ver projetos
        </a>
    </section>
</x-layout>
