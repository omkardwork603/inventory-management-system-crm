<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Account Settings') }}
            </h2>
            <span class="text-xs text-gray-500 font-medium bg-gray-100 px-3 py-1 rounded-full border border-gray-200">
                Manage Profile & Security
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- User Overview Card --}}
            <div class="bg-white overflow-hidden shadow-sm border border-gray-200/80 sm:rounded-xl p-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-blue-600 text-white font-bold text-xl flex items-center justify-center shrink-0 shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 leading-tight">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    <div class="text-xs text-gray-400 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100 self-stretch sm:self-auto text-center">
                        Member since {{ Auth::user()->created_at->format('M Y') }}
                    </div>
                </div>
            </div>

            {{-- Profile Information --}}
            <div class="bg-white overflow-hidden shadow-sm border border-gray-200/80 sm:rounded-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-2.5 pb-4 mb-6 border-b border-gray-100">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900">Personal Information</h3>
                            <p class="text-xs text-gray-500">Update your account's profile information and email address.</p>
                        </div>
                    </div>
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="bg-white overflow-hidden shadow-sm border border-gray-200/80 sm:rounded-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-2.5 pb-4 mb-6 border-b border-gray-100">
                        <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900">Update Password</h3>
                            <p class="text-xs text-gray-500">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                    </div>
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="bg-white overflow-hidden shadow-sm border border-red-200/80 sm:rounded-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-2.5 pb-4 mb-6 border-b border-gray-100">
                        <div class="p-2 bg-red-50 text-red-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-red-600">Danger Zone</h3>
                            <p class="text-xs text-gray-500">Permanently delete your account and all associated resources.</p>
                        </div>
                    </div>
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>