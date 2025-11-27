<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required'],
        ],
        [
            'name.required' => 'O campo de nome é obrigatório.',
            'email.unique' => 'O email já está em uso.',
            'email.required' => 'O campo de email é obrigatório.',
            'address.required' => 'O campo de endereço é obrigatório.',
            'phone.required' => 'O campo de telefone é obrigatório.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'type.required' => 'O campo de tipo de usuário é obrigatório.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);
        
        $user->assignRole($request->type);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
