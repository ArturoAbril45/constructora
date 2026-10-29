@props(['label', 'value', 'tone' => 'light'])
@php
 $dark = $tone === 'dark';
@endphp
<div class="p-5 border bg-white border-slate-200 text-slate-800">
 <p class="text-xs font-medium text-slate-400">{{ $label }}</p>
 <p class="mt-2 text-2xl font-bold text-orange-600">${{ number_format($value, 2) }}</p>
</div>
