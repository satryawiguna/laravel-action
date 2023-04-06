<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AttemptLogout
{
    use AsAction;

    public function handle(ActionRequest $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        return $this->handle($request);
    }
}
