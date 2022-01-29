<x-filament::widget>
    <style>
        .bg-success-500 {
            background-color: rgb(11, 232, 129);
        }
    </style>
    <x-filament::card>
        @php
        $user = \Filament\Facades\Filament::auth()->user();
        @endphp

        <div class="h-12 flex items-center justify-between space-x-4 rtl:space-x-reverse">
            <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                Serviço de Cache
            </h2>

            <button type="button" wire:click="resetCache"
                class="flex items-center px-6 py-2 text-sm text-center rounded text-white {{ $buttonColor }}">
                {{ $buttonLabel }}

                @if (!$buttonWasClicked)
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-2 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                @endif
                
            </button>
        </div>
    </x-filament::card>
</x-filament::widget>