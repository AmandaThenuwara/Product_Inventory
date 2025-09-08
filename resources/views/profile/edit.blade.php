<x-app-layout>
    <x-slot name="header">
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#3B82F6]/5 to-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-[#3B82F6]/10">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="h-20 w-20 rounded-full bg-gradient-to-br from-[#3B82F6]/80 to-[#2563EB] flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                                <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#3B82F6]/10 text-[#3B82F6]">
                                    Supplier Admin
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 flex flex-col items-end">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ __('Member since') }}: {{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3B82F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ __('Account active') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="max-w-3xl mx-auto">
                @include('profile.partials.update-profile-information-form')
                @include('profile.partials.update-password-form')
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
        
    </x-slot>

    
</x-app-layout>
