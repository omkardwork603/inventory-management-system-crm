<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Brand</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Brand Name *</label>
                        <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $brand->description) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('brands.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>