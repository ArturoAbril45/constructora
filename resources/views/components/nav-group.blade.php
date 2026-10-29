@props(['label', 'open' => false])
<div x-data="{ expanded: @js($open) }" class="mb-1">
 <button type="button" @click="expanded = !expanded"
 class="w-full flex items-center justify-between gap-3 px-3 py-2.5 text-slate-600 hover:bg-slate-100 {{ $open ? 'bg-slate-100' : '' }}">
 <span class="flex items-center gap-3">
 <x-nav-icon name="grid" />
 <span>{{ $label }}</span>
 </span>
 <svg :class="expanded ? 'rotate-180' : ''" class="h-4 w-4 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
 <path d="m6 9 6 6 6-6" />
 </svg>
 </button>
 <div x-show="expanded" x-transition class="pl-10 pr-2 py-1 space-y-0.5">
 {{ $slot }}
 </div>
</div>
