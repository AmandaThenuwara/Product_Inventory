<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background pattern -->
        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 bg-[#F3F4F6] opacity-80"></div>
            <div class="absolute inset-y-0 right-0 w-1/3 bg-[#3B82F6]/5"></div>
            <div class="absolute bottom-0 left-0 w-1/2 h-1/3 bg-gradient-to-tr from-[#3B82F6]/10 to-transparent"></div>
            <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-gradient-to-bl from-[#3B82F6]/10 to-transparent"></div>
            <div class="hidden sm:block absolute top-20 left-20">
                <div class="w-3 h-3 rounded-full bg-[#3B82F6]/40"></div>
            </div>
            <div class="hidden sm:block absolute bottom-32 right-20">
                <div class="w-6 h-6 rounded-full bg-[#3B82F6]/30"></div>
            </div>
        </div>

        <div class="min-h-screen flex items-center justify-center p-4 relative z-10">
            <div class="flex bg-white rounded-xl shadow-2xl overflow-hidden max-w-5xl w-full border border-gray-100 backdrop-blur-sm">
                <!-- Left side with form -->
                <div class="w-full md:w-1/2 p-10">
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-[#3B82F6] p-2 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm8 8v2h1v-2h-1zm-2-6H7v4h6V7zm2 4h1V7h-1v4zm1-9H6v1h10V2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold bg-gradient-to-r from-[#3B82F6] to-[#1E40AF] bg-clip-text text-transparent">StockWise</h2>
                        </div>
                        <p class="text-sm text-gray-600 ml-1 font-medium">Enterprise inventory management solution for businesses of all sizes</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-white to-[#F3F4F6]/70 rounded-lg p-8 border border-gray-100 shadow-md">
                        {{ $slot }}
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} StockWise. All rights reserved.</p>
                        <div class="flex justify-center gap-4 mt-2">
                            <a href="#" class="text-[#3B82F6] hover:text-[#1E40AF] text-xs">Terms</a>
                            <a href="#" class="text-[#3B82F6] hover:text-[#1E40AF] text-xs">Privacy</a>
                            <a href="#" class="text-[#3B82F6] hover:text-[#1E40AF] text-xs">Support</a>
                        </div>
                    </div>
                </div>
                
                <!-- Right side with illustration -->
                <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-[#3B82F6]/10 to-[#3B82F6]/30 relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#3B82F6]/20 to-[#3B82F6]/5 rounded-full -mr-20 -mt-20 blur-xl"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-[#3B82F6]/30 to-[#3B82F6]/5 rounded-full -ml-20 -mb-20 blur-xl"></div>
                    
                    <div class="absolute inset-0 flex justify-center items-center p-10">
                        <div class="relative w-full max-w-md">
                            <!-- Main image -->
                            <img src="{{ asset('images/inventory.jpg') }}" alt="Inventory Management" 
                                class="w-full h-auto rounded-lg shadow-2xl object-cover border-4 border-white/50"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/500x400/3B82F6/FFFFFF?text=StockWise+Inventory';">
                            
                            <!-- Decorative elements overlaying the image -->
                            <div class="absolute -top-4 -right-4 bg-white p-3 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="absolute -bottom-4 -left-4 bg-white p-3 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
