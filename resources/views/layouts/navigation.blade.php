<nav x-data="{ open: false }" class="bg-purple-700 border-b border-purple-600 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo (optional) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('logo/logo2.png') }}" alt="Logo" class="mx-auto" style="width: 80px;">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-purple-300">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Add more links as necessary -->
                    <x-nav-link :href="route('houses.index')" :active="request()->routeIs('houses.index')" class="text-white hover:text-purple-300">
                        {{ __('Houses') }}
                    </x-nav-link>

                    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" class="text-white hover:text-purple-300">
                        {{ __('Rooms') }}
                    </x-nav-link>

                    <x-nav-link :href="route('tenants.index')" :active="request()->routeIs('tenants.index')" class="text-white hover:text-purple-300">
                        {{ __('Tenants') }}
                    </x-nav-link>

                    <x-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.index')" class="text-white hover:text-purple-300">
                        {{ __('Payments') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6" x-data="{ open: false }">
                <button @click="open = ! open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-700 hover:bg-purple-600 hover:text-purple-300 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <svg class="fill-current h-4 w-4 ml-1 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-purple-700 ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="py-1">
                        <x-dropdown-link :href="route('profile.edit')" class="text-white hover:text-purple-300">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:text-purple-300">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-purple-300 hover:bg-purple-600 focus:outline-none focus:bg-purple-600 focus:text-purple-300 transition duration-150 ease-in-out">
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
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-purple-300">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('houses.index')" :active="request()->routeIs('houses.index')" class="text-white hover:text-purple-300">
                {{ __('Houses') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" class="text-white hover:text-purple-300">
                {{ __('Rooms') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tenants.index')" :active="request()->routeIs('tenants.index')" class="text-white hover:text-purple-300">
                {{ __('Tenants') }}
            </x-nav-link>
            <x-responsive-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.index')" class="text-white hover:text-purple-300">
                {{ __('Payments') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-purple-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-purple-300">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:text-purple-300">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
