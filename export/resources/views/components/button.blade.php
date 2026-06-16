@props([
    'variant' => 'primary',
    'size' => 'md',
    'radius' => 'lg',
    'as' => 'button',
    'url' => null,
    'icon' => null,
    'iconStyle' => 'solid',
    'iconResolution' => 16,
    'iconPosition' => 'right',
    'base' => [
        'inline-flex items-center justify-center font-semibold rounded-full group',
        'transition-all duration-300 ease-in-out',
        'outline-1 outline-transparent -outline-offset-1',
    ],
    'variants' => [
        'primary' => '
            bg-brand-primary 
            text-brand-secondary 
            outline-brand-primary 
            hover:text-brand-primary 
            hover:bg-brand-secondary 
            hover:outline-brand-secondary',
        'secondary' => '
            bg-brand-secondary 
            text-brand-primary 
            outline-brand-secondary 
            hover:text-brand-secondary 
            hover:bg-brand-primary 
            hover:outline-brand-primary',
        'outline' => '
            bg-transparent 
            text-brand-primary 
            outline-brand-primary 
            hover:bg-brand-primary 
            hover:text-brand-secondary
            hover:outline-brand-primary',
    ],
    'sizes' => [
        'md' => 'px-6 py-3 text-base leading-none',
        'lg' => 'px-6 py-4 text-lg',
        'xl' => 'px-14 py-6 text-xl',
    ],
    'icon_colors' => [
        'primary' => 'text-white group-hover:text-brand-primary',
        'secondary' => 'text-brand-primary group-hover:text-brand-secondary',
        'outline' => 'text-brand-primary group-hover:text-brand-secondary',
    ],
    'icon_sizes' => [
        'md' => 'size-4',
        'lg' => 'size-5',
        'xl' => 'size-6',
    ],
])

@php
    $classes = implode(' ', array_merge($base, [
        $variants[$variant],
        $sizes[$size],
        $icon && $iconPosition === 'left' ? 'flex-row-reverse' : null,
    ]));
    $icon_classes = implode(' ', [$icon_colors[$variant], $icon_sizes[$size]]);
    $icon_position_classes = $iconPosition === 'left'
        ? 'mr-2 group-hover:-translate-x-2'
        : 'ml-2 group-hover:translate-x-2';
@endphp

@if ($url)
    <a href="{{ $url }}" {{ $attributes->twMerge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if ($icon)
            <x-icon :name="$icon" :icon-style="$iconStyle" :icon-resolution="$iconResolution"
                class="transition-transform ease-in-out duration-300 {{ $icon_position_classes }} {{ $icon_classes }}" />
        @endif
    </a>
@else
    <{{ $as }} {{ $attributes->twMerge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if ($icon)
            <x-icon :name="$icon" :icon-style="$iconStyle" :icon-resolution="$iconResolution"
                class="transition-transform ease-in-out duration-300 {{ $icon_position_classes }} {{ $icon_classes }}" />
        @endif
    </{{ $as }}>
@endif
