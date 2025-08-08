@props([
    'href' => '#',
    'size' => 'md',
    'color' => 'blue',
])

@php
    $classes = [
        'inline-flex items-center border border-transparent rounded-md font-semibold uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
        'bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900' // Primary color
    ];

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
    
    $sizes = [
        'xs' => 'px-2.5 py-1 text-xs',
        'sm' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-6 py-3 text-lg',
        'xs' => 'px-8 py-4 text-xl',
        'md' => 'px-4 py-2 text-base',
    ];

    $colors = [
        'blue' => 'text-blue-600 hover:text-blue-800',
        'red' => 'text-red-600 hover:text-red-800',
        'green' => 'text-green-600 hover:text-green-800',
        'primary' => 'inline-flex items-center border border-transparent rounded-md font-semibold uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900'
    ];
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $sizes[$size] . ' ' . $colors[$color]]) }}>
    {{ $slot }}
</a>