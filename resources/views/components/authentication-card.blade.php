<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-white to-gray-50">
    <div class="mb-8 transform transition-all duration-500 hover:scale-105">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white shadow-xl overflow-hidden sm:rounded-lg border-t-4 border-green-500 transition-all duration-300">
        {{ $slot }}
    </div>
    
    <div class="w-full sm:max-w-md mt-6 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Espreso Brew</p>
    </div>
</div>
