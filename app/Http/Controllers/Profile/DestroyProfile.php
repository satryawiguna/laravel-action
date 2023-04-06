<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DestroyProfile
{
    use AsAction;

    public function handle(User $user, Session $session): RedirectResponse
    {
        Auth::logout();

        $user->delete();

        $session->invalidate();
        $session->regenerateToken();

        return Redirect::to('/');
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'current-password'],
        ];
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        return $this->handle($request->user(), $request->session());
    }
}
