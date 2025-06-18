<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $telephon = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephon' => ['required', 'phone:BY'], // BY — Беларусь
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('index', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Создайте новый аккаунт')" :description="__('Введите свои данные для регистрации')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Имя')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Введите имя пользователя')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email адрес')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Telephon -->
        <flux:input
            wire:model="telephon"
            :label="__('Номер телефона')"
            type="phone"
            required
            autocomplete="phone"
            placeholder=""
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Пароль')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Пароль')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Повторите пароль')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Повторите пароль')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Зарегистрироваться') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Уже есть свой аккаунт?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Войти') }}</flux:link>
    </div>
</div>
