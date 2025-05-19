@props(['label', 'for', 'type' => 'text', 'value' => null, 'required' => false, 'autocomplete' => null])

<div class="mb-6">
    <x-label for="{{ $for }}" value="{{ $label }}" />
    <x-input 
        id="{{ $for }}" 
        name="{{ $for }}"
        type="{{ $type }}"
        class="block mt-1 w-full" 
        {{ $value ? 'value=' . $value : '' }}
        {{ $required ? 'required' : '' }}
        {{ $autocomplete ? 'autocomplete=' . $autocomplete : '' }}
        {{ $attributes }}
    />
</div> 