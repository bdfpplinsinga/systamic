
@props([
    'base' =>'base-grid',
    'as' => null,
])

@php
    $classes = implode(' ', [$base]);
@endphp

<{{ $as ?? 'div' }} {{ $attributes->twMerge(["class" => $classes]) }}>
    {{ $slot }}
</{{ $as ?? 'div' }}>