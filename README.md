# Portfólio — Caio Tsutiya Marcidele

Portfólio pessoal construído com **Laravel 13**, **Blade** e **Tailwind CSS 4**. Todo o conteúdo foi levantado a partir dos meus repositórios públicos em [github.com/Mrcidele](https://github.com/Mrcidele): READMEs, código-fonte e metadados de cada projeto.

## Funcionalidades

- Página única com hero, sobre, stack, projetos em destaque, arquivo completo, trajetória e contato
- Página de detalhes para cada projeto (`/projetos/{slug}`), com destaques, fluxo de arquitetura e endpoints
- Filtro de projetos por tecnologia
- Distribuição de linguagens calculada a partir dos projetos
- Tema claro/escuro com preferência salva no navegador
- Layout responsivo, animações respeitando `prefers-reduced-motion` e página 404 personalizada
- Não depende de banco de dados

## Tecnologias

| Camada | Tecnologia |
|---|---|
| Back-end | PHP 8.3+ e Laravel 13 |
| Views | Blade (componentes anônimos) |
| Estilo | Tailwind CSS 4 via Vite |
| Testes | PHPUnit |
| Ícones | [Devicon](https://devicon.dev) (MIT), servidos localmente |

## Estrutura

```text
app/
├── Http/Controllers/PortfolioController.php   ← home e detalhes do projeto
└── Services/PortfolioService.php              ← leitura e organização dos dados
config/portfolio.php                           ← todo o conteúdo do portfólio
resources/
├── css/app.css                                ← tema, cores e animações
├── js/app.js                                  ← tema, menu, filtro e animações
└── views/
    ├── components/                            ← layout, card de projeto, ícones...
    ├── home.blade.php
    ├── projects/show.blade.php
    └── errors/404.blade.php
tests/Feature/PortfolioTest.php
```

## Como executar

Pré-requisitos: PHP 8.3+, Composer e Node.js.

```bash
git clone https://github.com/Mrcidele/portfolio.git
cd portfolio
composer setup
php artisan serve
```

O `composer setup` instala as dependências, cria o `.env`, gera a chave da aplicação e compila os assets. Acesse `http://localhost:8000`.

Para desenvolver com hot reload, rode `npm run dev` em outro terminal.

## Editando o conteúdo

Tudo fica em `config/portfolio.php`:

- `profile` — nome, avatar, links e textos do "Sobre"
- `skills` e `tech_icons` — seção de stack
- `patterns` — padrões de projeto e em quais repositórios aparecem
- `timeline` — linha do tempo
- `projects` — cada projeto com `slug`, `repo`, `language`, `category`, `summary`, `description`, `stack` e, opcionalmente, `highlights`, `endpoints`, `flow`, `featured` e `team`

## Testes

```bash
php artisan test
```
