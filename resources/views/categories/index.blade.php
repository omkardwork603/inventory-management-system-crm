@extends('layouts.app')

@section('header_title', 'Categories')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card / Page Banner -->
    <div class="bg-white p-6 rounded-xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Category Management</h2>
            <p class="text-xs text-slate-500 mt-1">Organize and structure your inventory product classifications.</p>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-medium px-4 py-2.5 rounded-lg text-xs transition-all duration-150 shadow-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Category
            </a>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-xs font-medium text-slate-600">
                <thead class="bg-slate-50/80 text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 w-16">ID</th>
                        <th scope="col" class="px-6 py-3.5">Category Name</th>
                        <th scope="col" class="px-6 py-3.5">Description</th>
                        {{-- <th scope="col" class="px-6 py-3.5 text-center">Products</th> --}}
                        <th scope="col" class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 bg-white">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <!-- ID -->
                            <td class="px-6 py-4 text-[16px] font-mono text-slate-400">
                                #{{ sprintf('%03d', $category->id) }}
                            </td>

                            <!-- Name -->
                            <td class="px-6 py-4 text-[16px] font-semibold text-slate-900">
                                {{ $category->name }}
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4 text-base text-slate-500 max-w-xs truncate">
                                {{ $category->description ?: '—' }}
                            </td>

                            <!-- Products Count Badge -->
                            {{-- <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200/60">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    {{ $category->products_count ?? $category->products->count() }}
                                </span>
                            </td> --}}

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-1">
                                    <!-- Edit Button -->
                                    <a href="{{ route('categories.edit', $category) }}" 
                                       title="Edit Category"
                                       class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Delete Category"
                                                class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="max-w-xs mx-auto text-center space-y-3">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-900">No categories created</p>
                                    <p class="text-lg text-slate-500">Get started by adding your first product category.</p>
                                    <a href="{{ route('categories.create') }}" class="inline-flex items-center text-xs font-medium text-indigo-600 hover:text-indigo-700">
                                        + Add Category Now
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-slate-200/80 bg-slate-50/50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

</div>
@endsection