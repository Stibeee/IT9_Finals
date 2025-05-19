<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-3 bg-gradient-to-r from-green-500 to-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-wider hover:from-green-600 hover:to-blue-700 focus:outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-200 active:from-green-700 active:to-blue-800 disabled:opacity-25 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg']) }}>
    {{ $slot }}
</button>
