<x-guest-layout>
    <!-- Header Section with Brand Icon Badge -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 ring-8 ring-indigo-50/50 dark:ring-indigo-950/30">
           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
</svg>
        </div>
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-3xl">
            {{ __('Create an Account') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Join us today to get started with your account.') }}
        </p>
    </div>

    <!-- Social Authentication Options -->
    {{-- <div class="grid grid-cols-2 gap-3 mb-6">
        <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700/50 shadow-xs transition duration-150 ease-in-out focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Google</span>
        </a>
        <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700/50 shadow-xs transition duration-150 ease-in-out focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20">
            <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            <span>GitHub</span>
        </a>
    </div> --}}

    <!-- Divider -->
    {{-- <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200 dark:border-gray-800"></div>
        </div>
        <div class="relative flex justify-center text-xs uppercase">
            <span class="px-3 text-gray-500 bg-white dark:bg-gray-900 dark:text-gray-400 font-medium tracking-wider">
                {{ __('Or register with email') }}
            </span>
        </div>
    </div> --}}

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name Field -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5 block" />
            <div class="relative rounded-xl shadow-xs">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input 
                    id="name" 
                    class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm transition duration-150 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                    placeholder="John Doe" 
                />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5 block" />
            <div class="relative rounded-xl shadow-xs">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input 
                    id="email" 
                    class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm transition duration-150 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username" 
                    placeholder="name@example.com" 
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5 block" />
            <div class="relative rounded-xl shadow-xs">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input 
                    id="password" 
                    class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm transition duration-150 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password" 
                    placeholder="••••••••" 
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5 block" />
            <div class="relative rounded-xl shadow-xs">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input 
                    id="password_confirmation" 
                    class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm transition duration-150 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                    placeholder="••••••••" 
                />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Terms and Conditions Checkbox -->
        {{-- <div class="flex items-start pt-1">
            <div class="flex items-center h-5">
                <input id="terms" type="checkbox" name="terms" required class="w-4 h-4 text-indigo-600 border-gray-300 rounded-md focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-offset-gray-900">
            </div>
            <div class="ml-2.5 text-xs text-gray-600 dark:text-gray-400">
                <label for="terms">
                    {{ __('I agree to the') }} 
                    <a href="#" class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Terms of Service') }}</a> 
                    {{ __('and') }} 
                    <a href="#" class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Privacy Policy') }}</a>.
                </label>
            </div>
        </div> --}}

        <!-- Gradient Call-To-Action Button -->
        <div class="pt-2">
            <button type="submit" class="relative group w-full inline-flex items-center justify-center px-4 py-3 text-sm font-semibold tracking-wide text-white transition-all duration-200 ease-in-out rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 focus:outline-hidden focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2 active:scale-[0.99] shadow-lg shadow-indigo-500/25 dark:shadow-indigo-900/30">
                <span>{{ __('Create Account') }}</span>
                <svg class="w-4 h-4 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>

        <!-- Footer Link -->
        <div class="pt-4 text-center text-sm text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-800">
            {{ __('Already registered?') }}
            <a class="ml-1 font-semibold text-indigo-600 hover:text-indigo-500 hover:underline focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 rounded-md transition duration-150 dark:text-indigo-400" href="{{ route('login') }}">
                {{ __('Sign in instead') }}
            </a>
        </div>
    </form>
</x-guest-layout>