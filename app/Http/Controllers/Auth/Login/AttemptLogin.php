<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class AttemptLogin
{
    use AsAction;

    public function handle(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function asController(LoginRequest $request): RedirectResponse
    {
        return $this->handle($request);
    }
}
