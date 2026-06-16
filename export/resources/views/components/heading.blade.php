@props([
    'color' => 'dark',
    'size' => 'h2',
    'as' => null,
    'weight' => 'bold', 
    'base' => 'font-headings tracking-tight',
    'colors' => [
        'dark' => 'text-dark-900',
        'light' => 'text-brand-secondary',
        'secondary' => 'text-primary-700 '
    ],
    'sizes' => [
        'jumbo' => 'xl:text-8xl lg:text-7xl md:text-6xl text-5xl',
        'h1' => 'xl:text-7xl lg:text-6xl md:text-5xl text-3xl',
        'h2' => 'lg:text-5xl md:text-4xl text-3xl',
        'h3' => 'md:text-4xl text-3xl',
        'h4' => 'md:text-3xl text-2xl',
        'h5' => 'md:text-2xl text-xl',
        'h6' => 'text-xl',
    ],
    'weights' => [
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        'black' => 'font-black',
    ],
])

@php 
    $classes = implode(' ', [$base, $colors[$color], $sizes[$size], $weights[$weight]]);
@endphp

<{{ $as ?? 'h2' }} {{ $attributes->twMerge(["class" => $classes]) }}>
    {{ $slot }}
</{{ $as ?? 'h2' }}>