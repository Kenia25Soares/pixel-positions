@props(['employer' => null, 'width' => 90])

@php
    $path = $employer?->logo ?? null;

    // normaliza caminho do Windows e remove 'public/'
    $normalized = $path ? preg_replace('#^public/#','', str_replace('\\','/',$path)) : null;

    // tenta URL do logo
    if ($normalized) {
        if (\Illuminate\Support\Str::startsWith($normalized, ['http://','https://','/'])) {
            $src = preg_replace('#^http://#', 'https://', $normalized);
        } else {
            $src = '/storage/' . ltrim($normalized, '/'); // evita depender de APP_URL
        }
    } else {
        $src = null;
    }

    // fallback com imagem real, seed por empregador
    $seed = $employer?->id ?? md5($employer?->name ?? 'pixel');
    $fallback = "https://picsum.photos/seed/{$seed}/{$width}/{$width}";
@endphp

<img
  src="{{ $src ?: $fallback }}"
  alt=""
  class="rounded-xl object-cover"
  style="width: {{ $width }}px; height: {{ $width }}px;"
  loading="lazy"
  onerror="this.onerror=null; this.src='{{ $fallback }}'"
>

{{-- @props(['employer', 'width' => 90])

<img src="{{ asset($employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}">
<img src="http://picsum.photos/seed/{{ rand(0, 100000) }}/{{ $width }}" alt="" class="rounded-xl"> --}}