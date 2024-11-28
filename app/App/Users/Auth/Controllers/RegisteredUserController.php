<?php

declare(strict_types=1);

namespace Gurulabs\App\Users\Auth\Controllers;

use Gurulabs\App\Controllers\Controller;
use Gurulabs\App\Users\ReadModel\UserDto;
use Gurulabs\Domain\Users\User;
use Gurulabs\Domain\Users\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

final class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $userDto = new UserDto(
            $request->name,
            $request->email,
            Hash::make($request->password),
        );

        $user = $this->userRepository->save($userDto);

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
