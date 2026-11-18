<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RecommendationController extends Controller
{
    /**
     * Recebe uma recomendação do formulário de contato (público).
     */
    public function store(Request $request): RedirectResponse
    {
        Recommendation::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]));

        return redirect(url('/').'#contato')->with('contact_status', 'Recomendação enviada! Obrigado pelo feedback.');
    }

    /**
     * Painel dos admins com as recomendações recebidas.
     */
    public function index(Request $request): View
    {
        $status = in_array($request->query('status'), Recommendation::STATUSES, true) ? $request->query('status') : null;

        return view('admin.recommendations', [
            'recommendations' => Recommendation::when($status, fn ($q) => $q->where('status', $status))->latest()->paginate(15)->withQueryString(),
            'counts' => Recommendation::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
            'status' => $status,
        ]);
    }

    /**
     * Avalia (aprova/rejeita/reabre) uma recomendação.
     */
    public function update(Request $request, Recommendation $recommendation): RedirectResponse
    {
        $recommendation->update($request->validate([
            'status' => ['required', Rule::in(Recommendation::STATUSES)],
        ]));

        return back();
    }

    public function destroy(Recommendation $recommendation): RedirectResponse
    {
        $recommendation->delete();

        return back();
    }
}
