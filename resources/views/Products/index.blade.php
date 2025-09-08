<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                {{ __('All Products') }}
            </h2>
            <a href="{{ route('products.create') }}" class="px-4 py-2 bg-gradient-to-r from-[#3B82F6] to-[#2563EB] text-white rounded-lg shadow-md hover:shadow-lg hover:from-[#2563EB] hover:to-[#1D4ED8] transition-all flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Add New Product') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Product List</h3>
                            <p class="text-sm text-gray-500 mt-1">Manage your inventory items</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Filter dropdown -->
                            <div class="relative">
                                <select id="product-filter" class="appearance-none px-4 py-2 pr-8 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent text-sm">
                                    <option value="all">All Products</option>
                                    <option value="in-stock">In Stock</option>
                                    <option value="low-stock">Low Stock</option>
                                    <option value="out-of-stock">Out of Stock</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Search input -->
                            <div class="relative">
                                <input type="text" id="product-search" placeholder="Search products..." class="px-4 py-2 pr-8 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-2 top-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="product-list">
                                @forelse($products as $product)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-[#3B82F6]/10 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $product->id }}</div>
                                                <div class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($product->description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if(isset($product->sku))
                                                {{ $product->sku }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            @if(isset($product->category))
                                                {{ $product->category }}
                                            @else
                                                Uncategorized
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->stock_quantity > 10)
                                            <div class="text-sm font-medium text-green-600">{{ $product->stock_quantity }} in stock</div>
                                        @elseif($product->stock_quantity > 0)
                                            <div class="text-sm font-medium text-amber-600">{{ $product->stock_quantity }} in stock</div>
                                        @else
                                            <div class="text-sm font-medium text-red-600">Out of stock</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        LKR{{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                                   
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-gray-600 hover:text-gray-900">
                                                <span class="sr-only">Edit</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <span class="sr-only">Delete</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No products found. 
                                        <a href="{{ route('products.create') }}" class="text-[#3B82F6] hover:underline">Add your first product</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination and bulk actions -->


    <!-- JavaScript for product search and filter functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product-search');
            const filterSelect = document.getElementById('product-filter');
            const productRows = document.querySelectorAll('#product-list tr');
            
            // Function to filter the product list based on search and filter criteria
            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterValue = filterSelect.value;
                
                productRows.forEach(row => {
                    // Get product information from the row
                    const productName = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase() || '';
                    const productSku = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const productCategory = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                    const stockInfo = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
                    
                    // Check if search term matches
                    const matchesSearch = productName.includes(searchTerm) || 
                        productSku.includes(searchTerm) || 
                        productCategory.includes(searchTerm);
                    
                    // Check if filter matches
                    let matchesFilter = true;
                    if (filterValue === 'in-stock' && !stockInfo.includes('in stock')) {
                        matchesFilter = false;
                    } else if (filterValue === 'low-stock' && !stockInfo.includes('in stock')) {
                        matchesFilter = false;
                    } else if (filterValue === 'out-of-stock' && !stockInfo.includes('out of stock')) {
                        matchesFilter = false;
                    }
                    
                    // Only show rows that match both search and filter criteria
                    if (matchesSearch && matchesFilter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Update visible count
                updateVisibleCount();
            }
            
            // Function to update the count of visible products
            function updateVisibleCount() {
                const visibleRows = [...productRows].filter(row => row.style.display !== 'none').length;
                const totalRows = {{ $products->total() }};
                const filteredCountElement = document.getElementById('filtered-count');
                
                if (filteredCountElement) {
                    filteredCountElement.textContent = `Showing ${visibleRows} of ${totalRows} products`;
                }
                
                // Also update the select all checkbox state
                if (typeof updateSelectAllCheckbox === 'function') {
                    updateSelectAllCheckbox();
                }
            }
            
            // Add event listeners for filtering
            searchInput.addEventListener('keyup', filterProducts);
            filterSelect.addEventListener('change', filterProducts);
            
            // Initialize filters
            filterProducts();
            
            // Handle "Select All" checkbox
            const selectAllCheckbox = document.getElementById('select-all-products');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                
                // Apply the checked state to all visible checkboxes
                productCheckboxes.forEach(checkbox => {
                    // Only affect checkboxes in visible rows
                    if (checkbox.closest('tr').style.display !== 'none') {
                        checkbox.checked = isChecked;
                    }
                });
            });
            
            // Update Select All checkbox when individual checkboxes change
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectAllCheckbox);
            });
            
            function updateSelectAllCheckbox() {
                const visibleCheckboxes = [...productCheckboxes].filter(
                    checkbox => checkbox.closest('tr').style.display !== 'none'
                );
                
                const allChecked = visibleCheckboxes.every(checkbox => checkbox.checked);
                const someChecked = visibleCheckboxes.some(checkbox => checkbox.checked);
                
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }
            
            // Enable the apply button only when checkboxes are selected
            const bulkActionSelect = document.getElementById('bulk-action');
            const bulkApplyBtn = document.getElementById('bulk-apply-btn');
            
            function updateApplyButton() {
                const hasSelection = [...productCheckboxes].some(checkbox => checkbox.checked);
                const hasAction = bulkActionSelect.value !== '';
                
                bulkApplyBtn.disabled = !(hasSelection && hasAction);
                bulkApplyBtn.classList.toggle('opacity-50', !(hasSelection && hasAction));
                bulkApplyBtn.classList.toggle('cursor-not-allowed', !(hasSelection && hasAction));
            }
            
            // Add event listeners for bulk action controls
            bulkActionSelect.addEventListener('change', updateApplyButton);
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateApplyButton);
            });
            selectAllCheckbox.addEventListener('change', updateApplyButton);
            
            // Initialize button state
            updateApplyButton();
        });
    </script>
</x-app-layout>