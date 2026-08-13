<div class="bg-slate-800 text-white w-full md:w-64 flex-shrink-0">
    <div class="p-5 flex items-center justify-between border-b border-slate-700">
        <span class="text-xl font-bold tracking-wider">📦 Mini Inventory</span>
    </div>
    <nav class="mt-4">
        <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('dashboard') ? 'bg-slate-700' : '' }}">
            🏠 Dashboard
        </a>
        
        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Management</div>
        <a href="{{ route('categories.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('categories.*') ? 'bg-slate-700' : '' }}">
            📂 Categories
        </a>
        <a href="{{ route('products.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('products.*') ? 'bg-slate-700' : '' }}">
            📦 Products
        </a>
        <a href="{{ route('suppliers.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('suppliers.*') ? 'bg-slate-700' : '' }}">
            🚚 Suppliers
        </a>
        <a href="{{ route('customers.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('customers.*') ? 'bg-slate-700' : '' }}">
            👥 Customers
        </a>

        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Inventory</div>
        <a href="{{ route('stock.index') }}?type=IN" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
            📥 Stock In
        </a>
        <a href="{{ route('stock.index') }}?type=OUT" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
            📤 Stock Out
        </a>
        <a href="{{ route('products.index') }}?status=Low+Stock" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 text-yellow-400">
            ⚠ Low Stock
        </a>

        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Transactions</div>
        <a href="{{ route('purchases.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('purchases.*') ? 'bg-slate-700' : '' }}">
            🛒 Purchases
        </a>
        <a href="{{ route('sales.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('sales.*') ? 'bg-slate-700' : '' }}">
            💰 Sales
        </a>

        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Reports</div>
        <a href="{{ route('reports.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('reports.index') ? 'bg-slate-700' : '' }}">
            📊 Reports
        </a>

        @if(auth()->user() && auth()->user()->role === 'admin')
            <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">System</div>
            <a href="{{ route('settings.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('settings.index') ? 'bg-slate-700' : '' }}">
                ⚙ Settings
            </a>
            <a href="{{ route('profile.edit') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                👤 Profile
            </a>
        @endif
    </nav>
</div>
