<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Supplier') }}
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Add New Supplier
                </h2>

                {{-- Validation Errors --}}
                @if ($errors->any())

                    <div class="mb-5 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">

                        <ul class="list-disc list-inside text-sm">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form
                    action="{{ route('suppliers.store') }}"
                    method="POST"
                    class="space-y-4"
                >

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Supplier Code --}}
                        <div>

                            <label
                                for="supplier_code"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Supplier Code *
                            </label>

                            <input
                                type="text"
                                id="supplier_code"
                                name="supplier_code"
                                value="{{ old('supplier_code', $supplierCode) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                required
                            >

                            @error('supplier_code')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Supplier Name --}}
                        <div>

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Supplier Name *
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                                required
                            >

                            @error('name')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Phone --}}
                        <div>

                            <label
                                for="phone"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Phone *
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                                required
                            >

                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div>

                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                            >

                            @error('email')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Address --}}
                        <div class="md:col-span-2">

                            <label
                                for="address"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Address
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                            >{{ old('address') }}</textarea>

                            @error('address')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="flex justify-end space-x-3 pt-4">

                        <a
                            href="{{ route('suppliers.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-5 rounded-md text-sm"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-md text-sm"
                        >
                            Save Supplier
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>