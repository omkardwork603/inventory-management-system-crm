<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">

            <h2 class="font-semibold text-xl text-gray-800">
                Suppliers

                <span class="text-sm text-gray-400 font-normal">
                    ({{ $suppliers->total() }} total)
                </span>
            </h2>

            <a
                href="{{ route('suppliers.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-bold"
            >
                + Add Supplier
            </a>

        </div>

    </x-slot>


    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="mb-5 p-3 bg-green-100 text-green-700 rounded-md text-sm">
                    {{ session('success') }}
                </div>

            @endif


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="overflow-x-auto">

                    <table class="min-w-full text-left border-collapse">

                        <thead>

                            <tr class="border-b bg-gray-50">

                                <th class="p-3 text-sm font-semibold text-gray-700">
                                    Code
                                </th>

                                <th class="p-3 text-sm font-semibold text-gray-700">
                                    Name
                                </th>

                                <th class="p-3 text-sm font-semibold text-gray-700">
                                    Phone
                                </th>

                                <th class="p-3 text-sm font-semibold text-gray-700">
                                    Email
                                </th>

                                <th class="p-3 text-sm font-semibold text-gray-700">
                                    Address
                                </th>

                                <th class="p-3 text-sm font-semibold text-gray-700 text-right">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($suppliers as $supplier)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="p-3 font-semibold text-gray-800">
                                        {{ $supplier->supplier_code }}
                                    </td>

                                    <td class="p-3 text-gray-700">
                                        {{ $supplier->name }}
                                    </td>

                                    <td class="p-3 text-gray-700">
                                        {{ $supplier->phone ?: '—' }}
                                    </td>

                                    <td class="p-3 text-gray-700">
                                        {{ $supplier->email ?: '—' }}
                                    </td>

                                    <td class="p-3 text-gray-700">
                                        {{ $supplier->address ?: '—' }}
                                    </td>

                                    <td class="p-3 text-right whitespace-nowrap">

                                        <a
                                            href="{{ route('suppliers.edit', $supplier) }}"
                                            class="text-blue-600 hover:underline mr-3"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('suppliers.destroy', $supplier) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this supplier?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-600 hover:underline"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="p-8 text-center text-gray-500"
                                    >
                                        No suppliers found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="mt-5">

                    {{ $suppliers->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>