@props([
    'size' => 'base',
    'base' => [
        'prose max-w-none',
    ],
    'sizes' => [
        'sm' => 'prose-sm',
        'base' => 'prose',
        'lg' => 'prose-lg',
        'xl' => 'prose-xl',
    ],
])

@php
    $classes = implode(' ', array_merge($base, [$sizes[$size]]));
@endphp


<div {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</div>


