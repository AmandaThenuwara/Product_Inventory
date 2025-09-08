<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Add New Product') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-[#3B82F6] transition-colors duration-200 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Back to Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-blue-50 overflow-hidden shadow-md rounded-lg hover:shadow-lg transition-all duration-300 border border-[#3B82F6]/10">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[#3B82F6]/20">
                        <div class="p-3 bg-gradient-to-r from-[#3B82F6] to-[#2563EB] rounded-lg shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-[#3B82F6]">Product Information</h3>
                            <p class="text-sm text-gray-500">Fill in the details to add a new product to inventory</p>
                        </div>
                    </div>

                    <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('POST')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div class="col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 group-hover:text-[#3B82F6] transition-colors duration-200">Product Name</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md shadow-sm hover:border-[#3B82F6]/50 transition-colors duration-200" 
                                        placeholder="Enter product name" 
                                        pattern="^[^@].*"
                                        title="Please enter a valid name"
                                        oninvalid="this.setCustomValidity('Please enter a valid name')"
                                        oninput="this.setCustomValidity('')"
                                        required>
                                </div>
                                <p id="name-error" class="mt-1 text-sm text-red-600 hidden">Please enter a valid name</p>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rs.</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" id="price" name="price" class="pl-7 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="0.00" required>
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                    <input type="number" min="0" id="stock_quantity" name="stock_quantity" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="0" required>
                                </div>
                                @error('stock_quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                        <option value="electronics">Electronics</option>
                                        <option value="mobile-devices">Mobile Devices</option>
                                        <option value="home-entertainment">Home Entertainment</option>
                                        <option value="computer-accessories">Computer Accessories</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                    <input type="text" id="sku" name="sku" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Product SKU">
                                </div>
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                        <option value="1">Acme Corporation</option>
                                        <option value="2">Global Tech</option>
                                        <option value="3">Eastern Imports</option>
                                        <option value="4">Tech Supplies Inc</option>
                                    </select>
                                </div>
                                @error('supplier')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                    <input type="number" min="0" id="reorder_level" name="reorder_level" class="pl-10 focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Minimum stock level">
                                </div>
                                @error('reorder_level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="4" class="focus:ring-[#3B82F6] focus:border-[#3B82F6] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter product description" required></textarea>
                                </div>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                <button type="submit" name="save_draft" value="1" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B82F6] transition-colors duration-200">
                                    Save as Draft
                                </button>
                                <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent shadow-md text-sm font-medium rounded-lg text-white bg-gradient-to-r from-[#3B82F6] to-[#2563EB] hover:from-[#2563EB] hover:to-[#1D4ED8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B82F6] transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('name-error');
            
            nameInput.addEventListener('input', function() {
                const value = this.value.trim();
                
                if (value.startsWith('@')) {
                    nameError.classList.remove('hidden');
                    this.classList.add('border-red-500');
                    this.classList.remove('border-gray-300');
                } else {
                    nameError.classList.add('hidden');
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-300');
                }
            });
            
            // Add form submission validation
            const form = nameInput.closest('form');
            form.addEventListener('submit', function(event) {
                const value = nameInput.value.trim();
                
                if (value.startsWith('@')) {
                    event.preventDefault();
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500');
                    nameInput.classList.remove('border-gray-300');
                    nameInput.focus();
                    
                    // Scroll to the error
                    nameInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });
    </script>
</x-app-layout>