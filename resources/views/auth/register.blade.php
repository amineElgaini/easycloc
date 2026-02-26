<x-guest-layout>

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
        }
    </style>

    {{-- Page Title --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Create Account</h1>
        <p class="text-slate-500">Join ColoManager to start managing your projects efficiently.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Full Name --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-slate-700" for="name">Full Name</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                    <span class="material-symbols-outlined text-xl">person</span>
                </div>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="John Doe"
                    class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all @error('name') border-red-400 @enderror"
                />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- Email --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-slate-700" for="email">Email Address</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                    <span class="material-symbols-outlined text-xl">mail</span>
                </div>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="name@company.com"
                    class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all @error('email') border-red-400 @enderror"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- Password + Confirm side by side --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Password --}}
            <div class="space-y-2" x-data="{ show: false }">
                <label class="block text-sm font-semibold text-slate-700" for="password">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <span class="material-symbols-outlined text-xl">lock</span>
                    </div>
                    <input
                        id="password"
                        :type="show ? 'text' : 'password'"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="block w-full pl-11 pr-11 py-3.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all @error('password') border-red-400 @enderror"
                    />
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                        <span class="material-symbols-outlined text-xl" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Confirm Password --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700" for="password_confirmation">Confirm Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                        <span class="material-symbols-outlined text-xl">lock_reset</span>
                    </div>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all @error('password_confirmation') border-red-400 @enderror"
                    />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2"
        >
            <span>Create Account</span>
            <span class="material-symbols-outlined text-xl">arrow_forward</span>
        </button>

    </form>

    {{-- Already registered --}}
    <div class="mt-8 pt-8 border-t border-slate-100 text-center">
        <p class="text-sm text-slate-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:underline ml-1">
                Log in here
            </a>
        </p>
    </div>

</x-guest-layout>