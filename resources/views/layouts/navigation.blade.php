<header class="bg-white border-b border-slate-200 sticky top-0 z-30 px-4 sm:px-6 py-3 flex items-center justify-between shadow-xs">
    <!-- Left Section: Page Title & Mobile Toggle -->
    <div class="flex items-center gap-4">
        <h1 class="text-lg font-semibold text-slate-800 tracking-tight">
            @yield('header_title', 'Inventory Management')
        </h1>
    </div>

    <!-- Right Section: Search, Notifications & User Menu -->
    <div class="flex items-center gap-3 sm:gap-4">
        
        <!-- Global Search Bar (Optional) -->
        {{-- <div class="hidden sm:flex items-center relative">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input 
                type="text" 
                placeholder="Search inventory..." 
                class="w-48 lg:w-64 pl-9 pr-3 py-1.5 text-xs font-medium text-slate-700 bg-slate-100/80 border border-transparent rounded-lg focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-150"
            />
        </div> --}}

        <!-- Notification Bell  {{-- <button type="button" class="relative p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none">
            <span class="sr-only">View notifications</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <!-- Optional Notification Indicator Dot -->
            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-indigo-600 ring-2 ring-white"></span>
        </button>-->
        --}}

        <div class="h-5 w-px bg-slate-200"></div>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
            <button 
                @click="open = !open" 
                type="button" 
                class="flex items-center gap-3 p-1.5 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none"
                id="user-menu-button" 
                aria-expanded="false" 
                aria-haspopup="true"
            >
                <!-- Avatar Initials -->
                <div class="w-8 h-8 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-semibold text-xs shadow-xs">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>

                <!-- User Meta -->
                <div class="hidden md:flex flex-col text-left">
                    <span class="text-xs font-semibold text-slate-800 leading-tight">
                        {{ auth()->user()->name }}
                    </span>
                    <span class="text-[11px] font-medium text-slate-400 capitalize">
                        {{ auth()->user()->role ?? 'User' }}
                    </span>
                </div>

                <!-- Chevron Icon -->
                <svg class="w-4 h-4 text-slate-400 transition-transform duration-150" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div 
                x-show="open" 
                x-transition:enter="transition ease-out duration-100" 
                x-transition:enter-start="transform opacity-0 scale-95" 
                x-transition:enter-end="transform opacity-100 scale-100" 
                x-transition:leave="transition ease-in duration-75" 
                x-transition:leave-start="transform opacity-100 scale-100" 
                x-transition:leave-end="transform opacity-0 scale-95" 
                class="absolute right-0 z-50 mt-2 w-52 origin-top-right rounded-xl bg-white py-1.5 shadow-lg ring-1 ring-black/5 focus:outline-none" 
                role="menu" 
                aria-orientation="vertical" 
                aria-labelledby="user-menu-button"
                style="display: none;"
            >
                <!-- Header Info inside Dropdown -->
                <div class="px-4 py-2 border-b border-slate-100">
                    <p class="text-xs font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>

                <!-- Profile Link -->
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors" role="menuitem">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile Settings
                </a>

                <div class="my-1 border-t border-slate-100"></div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50 transition-colors" role="menuitem">
                        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>