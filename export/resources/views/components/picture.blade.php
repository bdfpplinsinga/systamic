@props([
    'image' => null,
    'alt' => null,
    'sizes' => '100vw',
    'cover' => false,
    'lazy' => false,
    'presets' => ['xs', 'sm', 'md', 'lg', 'xl', '2xl'],
    'fallbackPreset' => 'lg',
])

@php
    if ($image instanceof \Statamic\Fields\Value) {
        $image = $image->value();
    }

    if ($image instanceof \Illuminate\Support\Collection) {
        $image = $image->first();
    } elseif (is_array($image)) {
        $image = reset($image);
    }

    $asset = $image instanceof \Statamic\Contracts\Assets\Asset
        ? $image
        : (is_string($image) ? \Statamic\Facades\Asset::find($image) : null);

    $source = $asset ?? $image;
    $url = $asset?->url() ?? $source;
    $extension = strtolower($asset?->extension() ?? pathinfo(parse_url((string) $url, PHP_URL_PATH), PATHINFO_EXTENSION));
    $mimeType = $asset?->mimeType() ?? match ($extension) {
        'jpg', 'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp',
        default => null,
    };

    $alt = $alt ?? $asset?->get('alt') ?? '';
    $isStaticImage = in_array($extension, ['svg', 'gif']);
    $imageClasses = $cover ? 'object-cover w-full h-full' : '';

    $focus = explode('-', $asset?->get('focus', '50-50-1') ?? '50-50-1');
    $objectPosition = sprintf('%s%% %s%%', $focus[0] ?? 50, $focus[1] ?? 50);

    $configuredPresets = config('statamic.assets.image_manipulation.presets', []);
    $responsivePresets = collect($presets)
        ->map(fn ($preset) => [
            'handle' => $preset,
            'webp_handle' => "{$preset}-webp",
            'width' => $configuredPresets[$preset]['w'] ?? null,
        ])
        ->filter(fn ($preset) => $preset['width'])
        ->values();
@endphp

@if ($source)
    <picture>
        @unless ($isStaticImage)
            <source
                srcset="@foreach ($responsivePresets as $preset)<s:glide :src="$source" :preset="$preset['webp_handle']" /> {{ $preset['width'] }}w{{ $loop->last ? '' : ', ' }}@endforeach"
                sizes="{{ $sizes }}"
                type="image/webp"
            >
            <source
                srcset="@foreach ($responsivePresets as $preset)<s:glide :src="$source" :preset="$preset['handle']" /> {{ $preset['width'] }}w{{ $loop->last ? '' : ', ' }}@endforeach"
                sizes="{{ $sizes }}"
                @if ($mimeType) type="{{ $mimeType }}" @endif
            >
        @endunless

        <img
            src="<s:glide :src="$source" :preset="$fallbackPreset" />"
            alt="{{ $alt }}"
            @if ($cover) style="object-position: {{ $objectPosition }}" @endif
            @if ($lazy) loading="lazy" @endif
            {{ $attributes->twMerge(['class' => $imageClasses]) }}
        >
    </picture>
@endif
