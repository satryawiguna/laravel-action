<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class EditProfile
{
    use AsAction;

    public function handle(User $user): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function asController(ActionRequest $request): Response
    {
        return $this->handle($request->user());
    }
}
