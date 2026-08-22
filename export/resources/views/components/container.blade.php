
@props([
    'base' =>'mx-auto w-full px-6 lg:px-8',
    'size' => 'lg',
    'as' => null,
    'sizes'=> [
        'sm'=> 'max-w-3xl',
        'md'=> 'max-w-5xl',
        'lg'=> 'max-w-6xl',
        'xl'=> 'max-w-7xl',
        '2xl'=> 'max-w-8xl',
        'full'=> 'max-w-none',
    ],
])

@php
    $classes = implode(' ', [$base, $sizes[$size]]);
@endphp

<{{ $as ?? 'div' }} {{ $attributes->twMerge(["class" => $classes]) }}>
    {{ $slot }}
</{{ $as ?? 'div' }}>