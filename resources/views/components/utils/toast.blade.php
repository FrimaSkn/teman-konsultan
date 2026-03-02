@props(['type' => 'success', 'message' => ''])

<div class="fixed z-[999] top-36 right-4"
    x-data="{ show: true }"
    x-show="show"
    x-transition
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-2"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-2"
    x-init="setTimeout(() => show = false, 8000)"
>
    <div {{ $attributes->merge(['class' => 'toast toast-'.$type]) }}>
        <div class="flex items-center gap-2">
            @if ($type == 'success')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            @elseif ($type == 'error' || $type == 'danger' || $type == 'warning')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
            @elseif ($type == 'info')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            @endif
            <span>{{ $slot }}</span>
            <button type="button" class="px-1 pt-0"  @click="show = false">
                <svg class="w-4 h-4 toast-close" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <progress x-data="{ value : 0 }"
                x-init="setInterval(()=> {
                        if(value == 100){
                            clearInterval();
                        }else{
                            value+=1
                            }},8000 / 100)"
                max="100"
                :value="value"
                class="absolute bottom-0 left-0 w-full h-1 p-0 rounded">
        </progress>
    </div>
</div>

