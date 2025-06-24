<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register', [
            'tenants' => (new Tenant)->tenants(),
            'userTypes' => (new UserType)->types(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate((new User)->rules());
        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'cpf' => $validated['cpf'],
            'professional_type' => $validated['professional_type'],
            // crefito or other professional registration document
            'document' => $validated['document'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'password' => Hash::make($validated['password']),
            'tenant_id' => $validated['tenant_id'],
        ]);
        // attribute roles by user type
        $user->assignRole($validated['professional_type']);

        event(new Registered($user));

        Auth::login($user);

        return to_route('forms.index');
    }
}
