<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->getValidations($request);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'professional_type' => $request->professional_type,
            // crefito or other professional registration document
            'document' => $request->document,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return to_route('dashboard');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function getValidations(Request $request): void
    {
        $request->validate((new \App\Models\User)->rules());
    }
}
