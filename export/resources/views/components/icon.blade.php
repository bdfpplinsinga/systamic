@props([
    'name',
    'iconStyle' => 'solid',
    'iconResolution' => 16,
    'size' => null,
    'label' => null,
    'base' => 'shrink-0',
    'sizes' => [
        'sm' => 'size-4',
        'md' => 'size-5',
        'lg' => 'size-6',
        'xl' => 'size-8',
    ],
])

@php
    $src = "icons/{$iconResolution}/{$iconStyle}/{$name}";
    $classes = implode(' ', array_filter([
        $base,
        $size ? ($sizes[$size] ?? $size) : null,
        $attributes->get('class'),
    ]));
@endphp

<s:svg
    :src="$src"
    :class="$classes"
    :title="$label"
    :aria-label="$label"
    :aria-hidden="$label ? null : 'true'"
    :role="$label ? 'img' : null"
/>
