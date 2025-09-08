<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#3B82F6] to-[#2563EB] border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-[#2563EB] hover:to-[#1D4ED8] focus:bg-[#2563EB] active:bg-[#1D4ED8] focus:outline-none focus:ring-2 focus:ring-[#3B82F6] focus:ring-offset-2 shadow-md hover:shadow-lg transition-all ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
