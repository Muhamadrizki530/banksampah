<nav x-data="{ open: false }"
    class="bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="flex items-center justify-between h-16">

            {{-- ================= LEFT ================= --}}
            <div class="flex items-center gap-10">

                {{-- Logo --}}
                <a href="{{ auth()->user()->role == 'admin'
                        ? route('admin.dashboard')
                        : route('nasabah.dashboard') }}"
                    class="flex items-center gap-3 group">

                    <div
                        class="w-11 h-11 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-700 flex items-center justify-center shadow-lg group-hover:scale-105 transition">

                        <i class="bi bi-recycle text-white text-lg"></i>

                    </div>

                    <div>

                        <h1 class="font-bold text-slate-800 leading-none">
                            Bank Sampah
                        </h1>

                        <span class="text-xs text-slate-500">
                            Digital Platform
                        </span>

                    </div>

                </a>

                {{-- Navigation (desktop) --}}
                <div class="hidden md:flex items-center gap-2">

                    <x-nav-link
                        :href="auth()->user()->role == 'admin'
                            ? route('admin.dashboard')
                            : route('nasabah.dashboard')"
                        :active="request()->routeIs('admin.dashboard') || request()->routeIs('nasabah.dashboard')">

                        <i class="bi bi-grid-fill me-2"></i>
                        Dashboard

                    </x-nav-link>

                </div>

            </div>


            {{-- ================= RIGHT (desktop) ================= --}}
            <div class="hidden md:flex items-center gap-4">

                {{-- Poin --}}
                @if(auth()->user()->role == 'nasabah')
                    <div
                        class="hidden lg:flex items-center gap-3 rounded-2xl bg-green-50 border border-green-100 px-4 py-2">

                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white">

                            <i class="bi bi-stars"></i>

                        </div>

                        <div class="leading-tight">

                            <small class="text-slate-500 block">
                                Total Poin
                            </small>

                            <strong class="text-green-700">
                                {{ number_format(Auth::user()->current_point) }}
                            </strong>

                        </div>

                    </div>
                @endif

                {{-- Dropdown --}}
                <x-dropdown align="right" width="72">

                    <x-slot name="trigger">

                        <button
                            class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 shadow-sm hover:shadow-md transition">

                            <div
                                class="w-11 h-11 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white fw-bold">

                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="bi bi-person-circle me-2"></i>
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- ================= HAMBURGER (mobile toggle) ================= --}}
            <div class="flex items-center md:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition">

                    <i class="bi bi-list text-2xl" x-show="!open"></i>
                    <i class="bi bi-x-lg text-xl" x-show="open" x-cloak></i>

                </button>

            </div>

        </div>

    </div>


    {{-- ================= MOBILE MENU ================= --}}
    <div x-show="open"
        x-transition
        x-cloak
        class="md:hidden bg-white border-t border-slate-200 shadow-lg">

        <div class="p-4">

            <div class="flex items-center gap-3 mb-4">

                <div
                    class="w-12 h-12 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 text-white fw-bold d-flex align-items-center justify-content-center">

                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                </div>

                <div>

                    <div class="fw-semibold">

                        {{ Auth::user()->name }}

                    </div>

                    <small class="text-muted">

                        {{ ucfirst(Auth::user()->role) }}

                        @if(auth()->user()->role=='nasabah')
                            • {{ Auth::user()->rank }}
                        @endif

                    </small>

                </div>

            </div>

            @if(auth()->user()->role=='nasabah')

                <div class="alert alert-success py-2 mb-3">

                    <i class="bi bi-stars me-2"></i>

                    <strong>{{ number_format(Auth::user()->current_point) }}</strong>
                    poin

                </div>

            @endif

            <x-responsive-nav-link
                :href="auth()->user()->role=='admin'
                    ? route('admin.dashboard')
                    : route('nasabah.dashboard')">

                <i class="bi bi-grid-fill me-2"></i>

                Dashboard

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('profile.edit')">

                <i class="bi bi-person-circle me-2"></i>

                Profil

            </x-responsive-nav-link>

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault();this.closest('form').submit();">

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Logout

                </x-responsive-nav-link>

            </form>

        </div>

    </div>

</nav>