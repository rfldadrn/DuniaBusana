{{-- resources/views/components/primary-button.blade.php --}}
@props(['type' => 'submit', 'size' => 'md']) {{-- Add 'size' prop, default to 'md' --}}

@php
    $classes = [
        'inline-flex items-center border border-transparent rounded-md font-semibold uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
        'bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900', // Primary color
    ];

    // Apply sizing classes based on the 'size' prop
    switch ($size) {
        case 'xs':
            $classes[] = 'px-2.5 py-1 text-xs';
            break;
        case 'sm':
            $classes[] = 'px-3 py-1.5 text-sm';
            break;
        case 'lg':
            $classes[] = 'px-6 py-3 text-lg';
            break;
        case 'xl':
            $classes[] = 'px-8 py-4 text-xl';
            break;
        case 'md':
        default:
            $classes[] = 'px-4 py-2 text-base'; // Default size
            break;
    }

    // Merge existing attributes with the dynamically generated classes
    $mergedClasses = Arr::toCssClasses($classes); // Helper to convert array to string
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $mergedClasses]) }}>
    {{ $slot }}
</button>

{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}
