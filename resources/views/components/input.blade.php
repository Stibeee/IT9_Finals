@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm transition-all duration-300 hover:border-gray-400 bg-white placeholder-gray-400']) !!}>
