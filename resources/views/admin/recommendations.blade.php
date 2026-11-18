@php
    $badges = [
        'pendente' => 'bg-amber-400/15 text-amber-300 ring-amber-400/30',
        'aprovada' => 'bg-emerald-400/15 text-emerald-300 ring-emerald-400/30',
        'rejeitada' => 'bg-rose-400/15 text-rose-300 ring-rose-400/30',
    ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">Admin · Recomendações</h2>
        <p class="mt-1 text-xs text-white/55">Mensagens enviadas pelo formulário de contato da landing page.</p>
    </x-slot>

    <div class="py-10">
        <div x-data="{ deleteUrl: '', deleteName: '' }" class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap gap-2 text-xs">
                <a href="{{ route('admin.recommendations.index') }}" class="rounded-lg px-3 py-1.5 ring-1 {{ $status ? 'text-white/60 ring-white/10 hover:text-white' : 'bg-white/10 text-white ring-white/20' }}">
                    Todas ({{ $counts->sum() }})
                </a>
                @foreach (\App\Models\Recommendation::STATUSES as $s)
                    <a href="{{ route('admin.recommendations.index', ['status' => $s]) }}" class="rounded-lg px-3 py-1.5 capitalize ring-1 {{ $status === $s ? 'bg-white/10 text-white ring-white/20' : 'text-white/60 ring-white/10 hover:text-white' }}">
                        {{ $s }} ({{ $counts[$s] ?? 0 }})
                    </a>
                @endforeach
            </nav>

            @forelse ($recommendations as $rec)
                <article class="panel p-5">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold">{{ $rec->name }}</p>
                            <a href="mailto:{{ $rec->email }}" class="text-xs text-white/55 hover:text-lumin-cyan">{{ $rec->email }}</a>
                            <span class="text-xs text-white/40">· {{ $rec->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <span class="rounded-md px-2 py-0.5 text-[11px] font-medium capitalize ring-1 {{ $badges[$rec->status] }}">{{ $rec->status }}</span>
                    </div>

                    <p class="mt-4 whitespace-pre-line text-sm leading-relaxed text-white/80">{{ $rec->message }}</p>

                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach (['aprovada' => 'Aprovar', 'rejeitada' => 'Rejeitar', 'pendente' => 'Reabrir'] as $value => $label)
                            @continue($rec->status === $value)
                            <form method="POST" action="{{ route('admin.recommendations.update', $rec) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $value }}">
                                <button type="submit" class="btn-ghost px-4 py-1.5 text-xs">{{ $label }}</button>
                            </form>
                        @endforeach
                        <button type="button" x-on:click="deleteUrl = @js(route('admin.recommendations.destroy', $rec)); deleteName = @js($rec->name); $dispatch('open-modal', 'confirm-recommendation-deletion')"
                            class="rounded-lg px-4 py-1.5 text-xs font-semibold text-rose-300 ring-1 ring-rose-400/30 transition hover:bg-rose-400/10">Excluir</button>
                    </div>
                </article>
            @empty
                <p class="panel p-8 text-center text-sm text-white/50">Nenhuma recomendação {{ $status ? "com status \"$status\"" : 'recebida ainda' }}.</p>
            @endforelse

            {{ $recommendations->links() }}

            <x-modal name="confirm-recommendation-deletion" maxWidth="md" centered focusable>
                <form method="POST" :action="deleteUrl" class="p-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-white">Excluir esta recomendação?</h2>
                    <p class="mt-1 text-sm text-white/60">
                        A recomendação de <span class="font-semibold text-white" x-text="deleteName"></span> será apagada permanentemente.
                    </p>

                    <div class="mt-6 flex justify-end gap-3">
                        <x-secondary-button x-on:click="$dispatch('close')">Cancelar</x-secondary-button>
                        <x-danger-button>Excluir</x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
