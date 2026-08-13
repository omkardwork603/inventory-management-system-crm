<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-slate-900 leading-tight tracking-tight">
                {{ __('Add New Category') }}
            </h2>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
                
                <!-- Card Header Banner -->
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-base font-bold text-slate-900">Category Details</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Enter a clear name and optional description for organizational grouping.</p>
                </div>

                <!-- Form Body -->
                <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <!-- Category Name Field -->
                    <div>
                        <label for="name" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Category Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative rounded-lg shadow-xs">
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="e.g. Electronics, Raw Materials, Office Supplies"
                                   class="w-full text-sm font-medium text-slate-800 placeholder-slate-400 bg-white border rounded-lg px-3.5 py-2.5 transition-all duration-150 focus:outline-none focus:ring-4 @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/10 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/10 @enderror" 
                                   required
                                   autofocus>
                        </div>
                        @error('name')
                            <div class="flex items-center gap-1.5 mt-1.5 text-xs text-rose-600 font-medium">
                                <svg class="w-4 h-4 flex-shrink-0 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="description" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                Description
                            </label>
                            <span class="text-[11px] text-slate-400">Optional</span>
                        </div>
                        <div class="relative rounded-lg shadow-xs">
                            <textarea id="description"
                                      name="description" 
                                      rows="4" 
                                      placeholder="Brief details regarding the items grouped under this category..."
                                      class="w-full text-sm font-medium text-slate-800 placeholder-slate-400 bg-white border rounded-lg px-3.5 py-2.5 transition-all duration-150 focus:outline-none focus:ring-4 @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500/10 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/10 @enderror">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="flex items-center gap-1.5 mt-1.5 text-xs text-rose-600 font-medium">
                                <svg class="w-4 h-4 flex-shrink-0 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Footer Action Bar -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-slate-300 bg-white text-xs font-semibold text-slate-700 rounded-lg hover:bg-slate-50 hover:text-slate-900 active:bg-slate-100 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold rounded-lg shadow-xs transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>