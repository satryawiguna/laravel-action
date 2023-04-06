<?php

namespace App\Http\Controllers\Auth\Register;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ViewRegister
{
    use AsAction;

    public function handle(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function asController(): Response
    {
        return $this->handle();
    }
}
