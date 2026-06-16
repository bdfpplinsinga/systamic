@props([
    'size' => 'base',
    'color' => 'default',
    'base' => [
        'prose prose-headings:font-black prose-headings:uppercase prose-headings:font-sans-condensed prose-headings:tracking-tight prose-headings:leading-none',
    ],
    'sizes' => [
        'xl' => 'prose-xl',
        'lg' => 'prose-lg',
        'base' => '',
    ],
    'colors' => [
        'default' =>
            '',
        'gray' =>
            '',
        'light-gray' =>
            '',
        'white' =>
            '',
    ],
])

@php
    $classes = implode(' ', array_merge($base, [$sizes[$size], $colors[$color]]));
@endphp


<div {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</div>


