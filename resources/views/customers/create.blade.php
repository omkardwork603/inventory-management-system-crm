<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Add Customer
            </h2>
            <a
                href="{{ route('customers.index') }}"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-600 bg-white hover:bg-gray-50 border border-gray-300 rounded-lg shadow-sm transition"
            >
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-200/80 sm:rounded-xl p-6 sm:p-8">

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Customer Details</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Enter primary contact and identification information below.</p>
                </div>

                <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Form Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Customer Code --}}
                        <div>
                            <label for="customer_code" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                                Customer Code <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="customer_code"
                                    name="customer_code"
                                    value="{{ old('customer_code', $customerCode) }}"
                                    required
                                    placeholder="CUST-0001"
                                    class="pl-9 w-full text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500/20 font-mono transition @error('customer_code') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                >
                            </div>
                            @error('customer_code')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        {{-- Full Name --}}
                        <div>
                            <label for="name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="John Doe"
                                    class="pl-9 w-full text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500/20 transition @error('name') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                >
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    required
                                    placeholder="+1 (555) 000-0000"
                                    class="pl-9 w-full text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500/20 transition @error('phone') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                >
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        {{-- Email Address --}}
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                                Email Address
                            </label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="customer@example.com"
                                    class="pl-9 w-full text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500/20 transition @error('email') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                >
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                            Street Address
                        </label>
                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            placeholder="Enter full address details..."
                            class="w-full text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500/20 transition @error('address') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500/20 @enderror"
                        >{{ old('address') }}</textarea>

                        @error('address')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    {{-- Form Actions --}}
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a
                            href="{{ route('customers.index') }}"
                            class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500/30 active:bg-blue-800"
                        >
                            Save Customer
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>