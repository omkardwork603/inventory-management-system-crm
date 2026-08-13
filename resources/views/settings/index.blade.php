<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">System Settings</h2></x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold mb-1">Company Name</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $settings->company_name ?? 'Mini Inventory System') }}" class="w-full border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold mb-1">Currency Symbol</label>
                        <input type="text" name="currency" value="{{ old('currency', $settings->currency ?? '₹') }}" class="w-full border-gray-300 rounded-md">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>