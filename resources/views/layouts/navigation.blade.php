<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left: Logo + Nav Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center me-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="bg-blue-600 rounded-md p-1.5">
                            <x-application-logo class="block h-6 w-6 fill-current text-white" />
                        </div>
                        <span class="text-gray-900 font-semibold text-sm tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-1">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150
                              {{ request()->routeIs('dashboard') 
                                 ? 'text-blue-600 bg-blue-50 font-semibold' 
                                 : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        {{ __('Dashboard') }}
                    </a>
                    {{-- Add more nav links here following the same pattern --}}
                    {{-- Example:
                    <a href="{{ route('servers.index') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150
                              {{ request()->routeIs('servers.*') 
                                 ? 'text-blue-600 bg-blue-50 font-semibold' 
                                 : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        {{ __('Servers') }}
                    </a>
                    --}}
                </div>
            </div>

            <!-- Right: Search + Notifications + User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">

                <!-- Global Search -->
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        placeholder="Global search..."
                        class="w-56 rounded-lg border border-gray-200 bg-gray-50 py-1.5 pl-9 pr-3 text-sm text-gray-700 placeholder-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-100 transition"
                    />
                </div>

                <!-- Notification Bell -->
                <div x-data="{ hasNotifications: true }" class="relative">
                    <button class="relative rounded-full p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition focus:outline-none">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <!-- Notification dot -->
                        <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-1 transition">
                            <!-- Avatar with initials -->
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-xs font-semibold text-white select-none">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                            </span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                {{ __('Profile') }}
                            </div>
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-md text-base font-medium transition
                      {{ request()->routeIs('dashboard') 
                         ? 'text-blue-600 bg-blue-50' 
                         : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center gap-3 mb-3">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-sm font-semibold text-white select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                </span>
                <div>
                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>