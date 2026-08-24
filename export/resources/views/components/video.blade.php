@props([
    'videoUrl' => null,
    'caption' => null,
    'base' => 'w-full',
])

@php
    $url = $videoUrl instanceof \Statamic\Fields\Value
        ? $videoUrl->value()
        : $videoUrl;

    $url = is_string($url) ? trim($url) : null;
    $embedUrl = null;
    $isMp4 = $url && (bool) preg_match('/\.mp4(?:\?.*)?$/i', $url);

    if ($url && preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([^?&\/]+)/i', $url, $matches)) {
        $embedUrl = 'https://www.youtube-nocookie.com/embed/' . $matches[1];
    } elseif ($url && preg_match('/vimeo\.com\/(?:video\/)?(\d+)/i', $url, $matches)) {
        $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
    }

    $classes = implode(' ', [$base]);
@endphp

@if ($embedUrl || $isMp4)
    <figure {{ $attributes->twMerge(['class' => $classes]) }}>
        <div class="aspect-video overflow-hidden rounded-lg bg-black">
            @if ($isMp4)
                <video class="size-full" controls preload="metadata">
                    <source src="{{ $url }}" type="video/mp4">
                    Je browser ondersteunt geen HTML5-video.
                </video>
            @else
                <iframe
                    class="size-full"
                    src="{{ $embedUrl }}"
                    title="{{ $caption ?: 'Video' }}"
                    loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                ></iframe>
            @endif
        </div>

        @if ($caption)
            <figcaption class="mt-3 text-sm text-gray-600">{{ $caption }}</figcaption>
        @endif
    </figure>
@endif
