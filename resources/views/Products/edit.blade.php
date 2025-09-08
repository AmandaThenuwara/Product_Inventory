<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-blue-50 overflow-hidden shadow-md rounded-lg hover:shadow-lg transition-all duration-300 border border-[#3B82F6]/10">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[#3B82F6]/20">
                        <div class="p-3 bg-gradient-to-r from-[#3B82F6] to-[#2563EB] rounded-lg shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-[#3B82F6]">Edit Product</h3>
                            <p class="text-sm text-gray-500">Update the details for this product</p>
                        </div>
                    </div>

                    <!-- Display validation errors -->
                    @if ($errors->any())
                    <div class="mb-6 bg-red-50 p-4 rounded-md border-l-4 border-red-500">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('products.update', ['product' => $product]) }}" method="POST" class="space-y-6" id="productEditForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Product Status Banner -->
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-blue-800">Product #{{ $product->id }}</h3>
                                    <p class="text-xs text-blue-500">Last updated: {{ $product->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            <div>
                                @if($product->stock_quantity > 10)
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        In Stock
                                    </span>
                                @elseif($product->stock_quantity > 0)
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        Low Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div class="col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md shadow-sm hover:border-[#3B82F6]/50 transition-colors duration-200" pattern="^[^@].*" title="Product name cannot start with @ symbol" required>
                                </div>
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $product->price) }}" class="pl-7 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <!-- Stock Quantity -->
                            <div>
                                <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <input type="number" min="0" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <select id="category" name="category" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md">
                                        <option value="">Select a category</option>
                                        <option value="electronics" {{ (old('category', $product->category ?? '') == 'electronics') ? 'selected' : '' }}>Electronics</option>
                                        <option value="mobile-devices" {{ (old('category', $product->category ?? '') == 'mobile-devices') ? 'selected' : '' }}>Mobile Devices</option>
                                        <option value="home-entertainment" {{ (old('category', $product->category ?? '') == 'home-entertainment') ? 'selected' : '' }}>Home Entertainment</option>
                                        <option value="computer-accessories" {{ (old('category', $product->category ?? '') == 'computer-accessories') ? 'selected' : '' }}>Computer Accessories</option>
                                        <option value="other" {{ (old('category', $product->category ?? '') == 'other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <!-- SKU -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Product SKU">
                                </div>
                            </div>

                            <!-- Supplier -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="supplier" class="block text-sm font-medium text-gray-700">Supplier</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <select id="supplier" name="supplier" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md">
                                        <option value="">Select a supplier</option>
                                        <option value="1" {{ (old('supplier', $product->supplier_id ?? '') == '1') ? 'selected' : '' }}>Acme Corporation</option>
                                        <option value="2" {{ (old('supplier', $product->supplier_id ?? '') == '2') ? 'selected' : '' }}>Global Tech</option>
                                        <option value="3" {{ (old('supplier', $product->supplier_id ?? '') == '3') ? 'selected' : '' }}>Eastern Imports</option>
                                        <option value="4" {{ (old('supplier', $product->supplier_id ?? '') == '4') ? 'selected' : '' }}>Tech Supplies Inc</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Reorder Level -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="reorder_level" class="block text-sm font-medium text-gray-700">Reorder Level</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                        </svg>
                                    </div>
                                    <input type="number" min="0" id="reorder_level" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level ?? '') }}" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Minimum stock level">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="4" class="focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-200 flex flex-col-reverse sm:flex-row sm:justify-between">
                            <div class="mt-3 sm:mt-0">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B82F6] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent shadow-md text-sm font-medium rounded-lg text-white bg-gradient-to-r from-[#3B82F6] to-[#2563EB] hover:from-[#2563EB] hover:to-[#1D4ED8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B82F6] transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for enhanced form interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get form elements
            const form = document.getElementById('productEditForm');
            const nameInput = document.getElementById('name');
            const priceInput = document.getElementById('price');
            const stockInput = document.getElementById('stock_quantity');
            const reorderInput = document.getElementById('reorder_level');
            
            // Name validation - prevent @ at beginning
            nameInput.addEventListener('input', function() {
                const value = this.value.trim();
                if (value.startsWith('@')) {
                    this.classList.add('border-red-500');
                    this.setCustomValidity('Product name cannot start with @ symbol');
                } else {
                    this.classList.remove('border-red-500');
                    this.setCustomValidity('');
                }
            });
            
            // Stock level visual indicator
            stockInput.addEventListener('input', function() {
                const value = parseInt(this.value) || 0;
                const reorderLevel = parseInt(reorderInput.value) || 10;
                
                if (value <= 0) {
                    this.classList.add('bg-red-50', 'border-red-300');
                    this.classList.remove('bg-yellow-50', 'border-yellow-300', 'bg-green-50', 'border-green-300');
                } else if (value <= reorderLevel) {
                    this.classList.add('bg-yellow-50', 'border-yellow-300');
                    this.classList.remove('bg-red-50', 'border-red-300', 'bg-green-50', 'border-green-300');
                } else {
                    this.classList.add('bg-green-50', 'border-green-300');
                    this.classList.remove('bg-red-50', 'border-red-300', 'bg-yellow-50', 'border-yellow-300');
                }
            });
            
            // Trigger the stock validation on page load and when reorder level changes
            reorderInput.addEventListener('input', function() {
                stockInput.dispatchEvent(new Event('input'));
            });
            
            // Trigger initial validation
            stockInput.dispatchEvent(new Event('input'));
            
            // Format price to 2 decimal places when user leaves the field
            priceInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        });
    </script>
</x-app-layout>