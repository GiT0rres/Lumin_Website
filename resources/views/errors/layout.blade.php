@php
    $code = $exception->getStatusCode();
    [$icon, $title, $text] = [
        401 => ['log-in', 'Faça login para continuar', 'Esta página exige que você esteja autenticado.'],
        403 => ['shield-check', 'Acesso restrito', 'Você não tem permissão para acessar esta página.'],
        404 => ['route', 'Página não encontrada', 'O endereço que você tentou acessar não existe ou foi movido.'],
        405 => ['triangle-alert', 'Método não permitido', 'Esta ação não é aceita neste endereço.'],
        419 => ['zap', 'Sessão expirada', 'Sua sessão expirou. Recarregue a página e tente novamente.'],
        429 => ['zap', 'Muitas requisições', 'Você fez muitas tentativas em pouco tempo. Aguarde um instante.'],
        503 => ['wrench', 'Em manutenção', 'Estamos fazendo ajustes. Volte em alguns minutos.'],
    ][$code] ?? ($code >= 500
        ? ['triangle-alert', 'Algo deu errado', 'Ocorreu um erro no servidor. Tente novamente mais tarde.']
        : ['triangle-alert', 'Não foi possível continuar', 'A requisição não pôde ser processada.']);
@endphp
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $code }} · {{ $title }} — Lumin</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-glow bg-dots relative flex min-h-screen flex-col overflow-hidden">
            <header class="border-b border-white/10 bg-ink/85 backdrop-blur-md">
                <nav class="mx-auto flex h-16 max-w-6xl items-center px-6">
                    <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="Lumin">
                        <img src="{{ asset('images/lumin-logo.png') }}" alt="Lumin" width="512" height="512" class="rounded-full" style="height:2.5rem;width:2.5rem">
                        <span class="text-lg font-semibold tracking-tight">Lumin</span>
                    </a>
                </nav>
            </header>

            <main class="mx-auto flex w-full max-w-6xl flex-1 items-center px-6 py-20">
                <div class="panel relative w-full overflow-hidden bg-surface px-8 py-14 text-center">
                    <div class="absolute inset-x-1/4 -top-10 h-40 rounded-full bg-lumin-magenta/25 blur-3xl"></div>

                    <span class="relative mx-auto flex size-14 items-center justify-center rounded-2xl text-white ring-2 ring-lumin-magenta/50" style="background-image: linear-gradient(135deg, #5a10dd, #c41bd9)">
                        <x-icon :name="$icon" class="size-6" />
                    </span>

                    <span class="eyebrow relative mt-8">Erro {{ $code }}</span>
                    <p class="text-gradient-pink relative mt-4 text-7xl font-bold leading-none tracking-tight sm:text-8xl">{{ $code }}</p>
                    <h1 class="section-title relative">{{ $title }}</h1>
                    <p class="relative mx-auto mt-3 max-w-md text-sm text-white/65">{{ $text }}</p>

                    <div class="relative mt-9 flex flex-wrap justify-center gap-3">
                        <a href="{{ url('/') }}" class="btn-brand">Voltar ao início <x-icon name="arrow-right" class="size-4" /></a>
                        <button type="button" onclick="history.back()" class="btn-ghost"><x-icon name="chevron-left" class="size-4" /> Página anterior</button>
                    </div>
                </div>
            </main>

            <footer class="relative py-8">
                <div class="section-edge absolute inset-x-0 top-0"></div>
                <p class="text-center text-xs text-white/55">© {{ date('Y') }} Lumin · Projeto de TCC</p>
            </footer>
        </div>
    </body>
</html>
