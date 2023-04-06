<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProfile
{
    use AsAction;

    public function handle(User $user, $validated): RedirectResponse
    {
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit');
    }

    public function asController(ProfileUpdateRequest $request): RedirectResponse
    {
        return $this->handle($request->user(), $request->validated());
    }
}
