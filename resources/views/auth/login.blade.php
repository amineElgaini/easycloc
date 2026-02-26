<x-guest-layout>

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
        }
    </style>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Page Title --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Sign in</h1>
        <p class="text-slate-500">Access your colocation dashboard and manage server deployments.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div class="space-y-2">
            <label class="text-sm font-semibold text-slate-700" for="email">Email Address</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="name@company.com"
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all @error('email') border-red-400 @enderror"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- Password --}}
        <div class="space-y-2" x-data="{ show: false }">
            <div class="flex justify-between items-center">
                <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-600 hover:underline">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full pl-11 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all @error('password') border-red-400 @enderror"
                />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0"
            />
            <label for="remember_me" class="ml-2 text-sm text-slate-600 cursor-pointer">
                {{ __('Remember me for 30 days') }}
            </label>
        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="w-full py-3.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2"
        >
            Sign In
            <span class="material-symbols-outlined text-[20px]">login</span>
        </button>
    </form>

    {{-- Register Link --}}
    @if (Route::has('register'))
        <div class="mt-8 pt-8 border-t border-slate-100 text-center">
            <p class="text-sm text-slate-500">
                Don't have an account yet?
                <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline">
                    Create an account
                </a>
            </p>
        </div>
    @endif

</x-guest-layout>