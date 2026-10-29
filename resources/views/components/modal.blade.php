@props(['show' => 'showModal', 'title' => '', 'maxWidth' => 'max-w-lg'])
<div x-show="{{ $show }}" x-cloak
 class="fixed inset-0 z-50 flex items-center justify-center p-4"
 style="display: none;">
 <div x-show="{{ $show }}" x-transition.opacity @click="{{ $show }} = false" class="absolute inset-0 bg-slate-900/50"></div>

 <div x-show="{{ $show }}" x-transition
 class="relative bg-white shadow-xl w-full {{ $maxWidth }} max-h-[90vh] overflow-y-auto">
 <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
 <h3 class="font-semibold text-slate-800">{{ $title }}</h3>
 <button type="button" @click="{{ $show }} = false" class="text-slate-400 hover:text-slate-600">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18" /><path d="m6 6 12 12" /></svg>
 </button>
 </div>
 <div class="px-6 py-5">
 {{ $slot }}
 </div>
 </div>
</div>
