<x-filament-panels::page>
    @if ($filter === 'preview')
        
        <div class=" rounded-md">
            <div class="container mx-auto mt-6 px-2">
                <!-- Widget Areas -->
                @foreach ($widgetAreas as $area)
                    <div x-data="{ expanded: {{ $loop->first ? 'true' : 'false' }} }" class="mb-4  rounded-lg shadow-sm border">
                        <div class="fi-ta-header-toolbar flex items-center justify-between rounded-lg gap-x-4 px-4 py-4 sm:px-6" style="background-color: #34495e;">
                            <div>
                                <h1 class="text-left text-white font-bold">
                                    {{ $area->name }} ({{ count($area->widgets) ?? 0 }})
                                </h1>
                            </div>
                            <div @click="expanded = ! expanded" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <path d="M7.121,17.121c-1.171,1.172-3.071,1.172-4.242,0c-1.172-1.171-1.172-3.071,0-4.242l7-7C10.465,5.293,11.232,5,12,5v7.243L7.121,17.121z" opacity=".35" />
                                    <path d="M21.121,12.879C21.707,13.464,22,14.232,22,15s-0.293,1.536-0.879,2.121c-1.171,1.172-3.071,1.172-4.242,0L12,12.243V5c0.768,0,1.535,0.293,2.121,0.879L21.121,12.879z" />
                                </svg>
                            </div>
                        </div>
                        <div x-show="expanded" x-collapse class='py-4 px-4 space-y-3'>
                            @forelse ($area->widgets as $widget)
                                <div class="w-full border rounded">
                                    <!-- Tailwind Card Component -->
                                    <div class="shadow rounded-lg widget-card">
                                        <div class="bg-gray-100 p-4 rounded-lg">
                                            <p class="text-center text-gray-700 font-bold">
                                                {{ $widget->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 border rounded">
                                    <!-- Tailwind Card Component -->
                                    <div class=" shadow rounded-lg widget-card">
                                        <div class="p-4 bg-gray-100 text-center">
                                            <p class="text-gray-700 font-bold">{{ __('filawidget::filawidget.No Widget Found') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @elseif ($filter === 'widgets')
        <div class="pb-4">

            @if (session('areaStatus'))
                <div class="p-3 mb-2 text-white rounded shadow" style="background: #19a5a1;">
                    <div class="flex gap-4 justify-between">
                        <div>
                            {{ session('areaStatus') }}
                        </div>
                        <div wire:click="hideAlert" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
                                <path d="M4.7070312 3.2929688L3.2929688 4.7070312L10.585938 12L3.2929688 19.292969L4.7070312 20.707031L12 13.414062L19.292969 20.707031L20.707031 19.292969L13.414062 12L20.707031 4.7070312L19.292969 3.2929688L12 10.585938L4.7070312 3.2929688 z" fill="#FFFDFD" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('widgetStatus'))
                <div class="p-3 mb-2 text-white rounded shadow" style="background: #19a5a1;">
                    <div class="flex gap-4 justify-between">
                        <div>
                            {{ session('widgetStatus') }}
                        </div>
                        <div wire:click="hideAlert" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
                                <path d="M4.7070312 3.2929688L3.2929688 4.7070312L10.585938 12L3.2929688 19.292969L4.7070312 20.707031L12 13.414062L19.292969 20.707031L20.707031 19.292969L13.414062 12L20.707031 4.7070312L19.292969 3.2929688L12 10.585938L4.7070312 3.2929688 z" fill="#FFFDFD" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif

            <div class="fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between py-2 mb-2">
                <div>
                    <h2 class="text-lg font-bold">{{ __('filawidget::filawidget.Areas with their widgets.') }}</h2>
                    <small>{{ __('filawidget::filawidget.Change the order of areas and widgets just by using Drag-and-drop.') }}</small>
                </div>
                <div class="fi-ac gap-3 flex flex-wrap items-center justify-start shrink-0">
                    <div class="p-2 rounded-full bg-primary-500">
                        <a href="?filter=preview">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
                                <path d="M15 5C6 5 0.19726562 14.408203 0.19726562 14.408203L0.19726562 14.435547C0.082350414 14.598369 0 14.7857 0 15C0 15.192109 0.068085697 15.361256 0.16210938 15.513672L0.16210938 15.544922C0.16110937 15.544922 5 25 15 25C25 25 29.837891 15.544922 29.837891 15.544922L29.837891 15.513672C29.931914 15.361256 30 15.192109 30 15C30 14.7857 29.91765 14.598369 29.802734 14.435547L29.802734 14.408203C29.802734 14.408203 24 5 15 5 z M 15 8C18.866 8 22 11.134 22 15C22 18.866 18.866 22 15 22C11.134 22 8 18.866 8 15C8 11.134 11.134 8 15 8 z M 15 12C13.343 12 12 13.343 12 15C12 16.657 13.343 18 15 18C16.657 18 18 16.657 18 15C18 13.343 16.657 12 15 12 z" fill="#FFFFFF" />
                            </svg>
                        </a>
                    </div>
                    <button wire:click="updateOrder" class="px-4 py-2 bg-primary text-white rounded hover:bg-blue-600" style="background: #19a5a1;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
                            <path d="M6 4C4.895 4 4 4.895 4 6L4 24C4 25.105 4.895 26 6 26L24 26C25.105 26 26 25.105 26 24L26 8L22 4L20 4L20 10C20 10.552 19.552 11 19 11L10 11C9.448 11 9 10.552 9 10L9 4L6 4 z M 16 4L16 9L18 9L18 4L16 4 z M 10 16L20 16C21.105 16 22 16.895 22 18L22 24L8 24L8 18C8 16.895 8.895 16 10 16 z" fill="#FFFDFD" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Container for sortable items --}}
            <div id="sortable-widget-areas" class="space-y-4">
                @foreach ($widgetAreas as $key => $widgetArea)
                    <div x-data="{ expanded: {{ $loop->first ? 'true' : 'false' }} }" id="sortable-container" class="sortable-widget-area-item rounded  space-y-4" data-id="{{ $widgetArea->id }}">
                        <div class="fi-ta-header-toolbar flex items-center justify-between gap-x-4 px-4 py-4 sm:px-6" style="border-bottom: 1px solid #ddd;">
                            <div class="flex gap-2">
                                <div class="p-2 rounded-full" style="background-color: #16a085;">
                                    <a href="{{ route('filament.admin.resources.widget-areas.edit',$widgetArea->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="18" height="18">
                                            <path d="M4 4L4 24C4 25.1 4.89 26 6 26L14.980469 26L15.019531 26L17.140625 26L26 17.140625L26 4L4 4 z M 12 6L18 6C18.55 6 19 6.45 19 7C19 7.55 18.55 8 18 8L12 8C11.45 8 11 7.55 11 7C11 6.45 11.45 6 12 6 z M 28.230469 18C27.780469 18 27.330469 18.169531 26.980469 18.519531L26.460938 19.039062L28.960938 21.539062L29.480469 21.019531C30.170469 20.329531 30.170469 19.209531 29.480469 18.519531C29.140469 18.169531 28.680469 18 28.230469 18 z M 25.039062 20.460938L20.509766 25L19.509766 26L18.480469 27.029297L18 30L20.980469 29.529297L24.589844 25.910156L24.599609 25.910156L25.910156 24.589844L27.539062 22.960938L26 21.419922L25.039062 20.460938 z" fill="#FFFFFF" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="p-2 rounded-full" style="background-color: #2980b9;">
                                    <a href="{{ route('filament.admin.resources.widgets.create') }}?area_id={{ $widgetArea->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="18" height="18">
                                            <path d="M24,4C12.972,4,4,12.972,4,24s8.972,20,20,20s20-8.972,20-20S35.028,4,24,4z M32.5,25.5h-7v7c0,0.829-0.672,1.5-1.5,1.5s-1.5-0.671-1.5-1.5v-7h-7c-0.828,0-1.5-0.671-1.5-1.5s0.672-1.5,1.5-1.5h7v-7c0-0.829,0.672-1.5,1.5-1.5s1.5,0.671,1.5,1.5v7h7c0.828,0,1.5,0.671,1.5,1.5S33.328,25.5,32.5,25.5z" fill="#FFFFFF" />
                                        </svg>
                                    </a>
                                </div>
                                <p style="line-height: 2;">{{ $widgetArea->name }} ({{ $widgetArea->widgets ? $widgetArea->widgets->count() : 0 }})</p>
                            </div>
                            <div @click="expanded = ! expanded" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <path d="M7.121,17.121c-1.171,1.172-3.071,1.172-4.242,0c-1.172-1.171-1.172-3.071,0-4.242l7-7C10.465,5.293,11.232,5,12,5v7.243L7.121,17.121z" opacity=".35" />
                                    <path d="M21.121,12.879C21.707,13.464,22,14.232,22,15s-0.293,1.536-0.879,2.121c-1.171,1.172-3.071,1.172-4.242,0L12,12.243V5c0.768,0,1.535,0.293,2.121,0.879L21.121,12.879z" />
                                </svg>
                            </div>
                        </div>
                        <div x-show="expanded" x-collapse id="sortable-widget-{{ $key + 1 }}" class="space-y-4 px-2 pb-4">
                            @forelse ($widgetArea->widgets as $widget)
                                <div class="sortable-widget-item  p-4 rounded cursor-move" data-id="{{ $widget->id }}" style="border: 1px dashed #000;">
                                    <div class="flex gap-4 justify-between">
                                        <div class="flex gap-3">
                                            <div class="p-2 mr-2 rounded-full" style="background-color: #2c3e50;">
                                                <a href="{{ route('filament.admin.resources.widgets.edit',$widget->id) }}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="18" height="18">
                                                        <path d="M10.5 6C7.468 6 5 8.468 5 11.5L5 36C5 39.309 7.691 42 11 42L22.605469 42C22.858469 41.042 23.225516 39.759 23.728516 38L11 38C9.897 38 9 37.103 9 36L9 16L39 16L39 22.521484C39.427 22.340484 39.8615 22.188422 40.3125 22.107422C40.7065 22.036422 41.102859 21.992953 41.505859 22.001953C42.015859 22.001953 42.515 22.067641 43 22.181641L43 11.5C43 8.468 40.532 6 37.5 6L10.5 6 z M 13.5 20 A 1.50015 1.50015 0 1 0 13.5 23L15.5 23 A 1.50015 1.50015 0 1 0 15.5 20L13.5 20 z M 21.5 20C20.672 20 20 20.671 20 21.5C20 22.329 20.672 23 21.5 23L34.5 23C35.328 23 36 22.329 36 21.5C36 20.671 35.328 20 34.5 20L21.5 20 z M 41.498047 24C41.224047 24.001 40.946969 24.025172 40.667969 24.076172C39.783969 24.235172 38.939563 24.696156 38.226562 25.410156L26.427734 37.208984C26.070734 37.565984 25.807969 38.011141 25.667969 38.494141L24.097656 43.974609C24.025656 44.164609 23.993 44.365406 24 44.566406C24.013 44.929406 24.155594 45.288406 24.433594 45.566406C24.710594 45.843406 25.067688 45.986 25.429688 46C25.630688 46.007 25.834391 45.975344 26.025391 45.902344L31.505859 44.332031C31.988859 44.192031 32.431062 43.930266 32.789062 43.572266L44.589844 31.773438C45.303844 31.060437 45.764828 30.216031 45.923828 29.332031C45.973828 29.053031 45.997047 28.775953 45.998047 28.501953C46.001047 27.307953 45.540687 26.179312 44.679688 25.320312C43.820687 24.460313 42.692047 23.998 41.498047 24 z M 13.5 26 A 1.50015 1.50015 0 1 0 13.5 29L15.5 29 A 1.50015 1.50015 0 1 0 15.5 26L13.5 26 z M 21.5 26C20.672 26 20 26.671 20 27.5C20 28.329 20.672 29 21.5 29L31.808594 29L34.779297 26.027344C34.688297 26.010344 34.596 26 34.5 26L21.5 26 z M 13.5 32 A 1.50015 1.50015 0 1 0 13.5 35L15.5 35 A 1.50015 1.50015 0 1 0 15.5 32L13.5 32 z M 21.5 32C20.672 32 20 32.671 20 33.5C20 34.329 20.672 35 21.5 35L25.808594 35L28.808594 32L21.5 32 z" fill="#FFFFFF" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <p style="line-height: 2;">{{ $widget->name }}</p>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                                                <path d="M15.634,3.634l-3.069-3.069c-0.312-0.312-0.819-0.312-1.131,0L8.366,3.634C7.862,4.138,8.219,5,8.931,5h6.137 C15.781,5,16.138,4.138,15.634,3.634z" />
                                                <path d="M12,9c-0.828,0-1.5-0.671-1.5-1.5v-4C10.5,2.671,11.172,2,12,2s1.5,0.671,1.5,1.5v4C13.5,8.329,12.828,9,12,9z" />
                                                <path d="M8.366,20.366l3.069,3.069c0.312,0.312,0.819,0.312,1.131,0l3.069-3.069C16.138,19.862,15.781,19,15.069,19H8.931 C8.219,19,7.862,19.862,8.366,20.366z" />
                                                <path d="M12,22c-0.828,0-1.5-0.671-1.5-1.5v-4c0-0.829,0.672-1.5,1.5-1.5s1.5,0.671,1.5,1.5v4C13.5,21.329,12.828,22,12,22z" />
                                                <path d="M7.5,10.5H5V8.931c0-0.713-0.862-1.07-1.366-0.566l-3.069,3.069c-0.312,0.312-0.312,0.819,0,1.131 l3.069,3.069C4.138,16.138,5,15.781,5,15.069V13.5h2.5C8.328,13.5,9,12.829,9,12S8.328,10.5,7.5,10.5z" opacity=".35" />
                                                <path d="M23.434,11.434l-3.069-3.069C19.862,7.862,19,8.219,19,8.931V10.5h-2.5c-0.828,0-1.5,0.671-1.5,1.5 s0.672,1.5,1.5,1.5H19v1.569c0,0.713,0.862,1.07,1.366,0.566l3.069-3.069C23.747,12.253,23.747,11.747,23.434,11.434z" opacity=".35" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="fi-ta-empty-state px-6 py-12">
                                    <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                                        <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                                            <svg class="fi-ta-empty-state-icon h-6 w-6 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                            </svg>        
                                        </div>
                                
                                        <h4 class="fi-ta-empty-state-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                            {{ __('filawidget::filawidget.No Widgets') }}
                                        </h4>
                                
                                        <p class="fi-ta-empty-state-description text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            {{ __('filawidget::filawidget.Create a widget to get started.') }}
                                        </p>
                                        
                                        <div class="fi-ta-actions flex shrink-0 items-center gap-3 flex-wrap justify-center mt-6">
                                            <a href="{{ route('filament.admin.resources.widgets.create') }}?area_id={{ $widgetArea->id }}" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">
                                                <svg class="fi-btn-icon transition duration-75 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path>
                                                </svg>      
                                                <span class="fi-btn-label">
                                                    {{ __('filawidget::filawidget.Create New Widget') }}
                                                </span>
                                            </a>
                                            <a href="{{ route('filament.admin.resources.widgets.index') }}" style="background: #19a5a1;" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">  
                                                <svg class="fi-btn-icon transition duration-75 h-5 w-5 text-white" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path d="M7 4.5 A 2.5 2.5 0 0 0 4.5 7 A 2.5 2.5 0 0 0 7 9.5 A 2.5 2.5 0 0 0 9.5 7 A 2.5 2.5 0 0 0 7 4.5 z M 15 4.5 A 2.5 2.5 0 0 0 12.5 7 A 2.5 2.5 0 0 0 15 9.5 A 2.5 2.5 0 0 0 17.5 7 A 2.5 2.5 0 0 0 15 4.5 z M 23 4.5 A 2.5 2.5 0 0 0 20.5 7 A 2.5 2.5 0 0 0 23 9.5 A 2.5 2.5 0 0 0 25.5 7 A 2.5 2.5 0 0 0 23 4.5 z M 7 12.5 A 2.5 2.5 0 0 0 4.5 15 A 2.5 2.5 0 0 0 7 17.5 A 2.5 2.5 0 0 0 9.5 15 A 2.5 2.5 0 0 0 7 12.5 z M 15 12.5 A 2.5 2.5 0 0 0 12.5 15 A 2.5 2.5 0 0 0 15 17.5 A 2.5 2.5 0 0 0 17.5 15 A 2.5 2.5 0 0 0 15 12.5 z M 23 12.5 A 2.5 2.5 0 0 0 20.5 15 A 2.5 2.5 0 0 0 23 17.5 A 2.5 2.5 0 0 0 25.5 15 A 2.5 2.5 0 0 0 23 12.5 z M 7 20.5 A 2.5 2.5 0 0 0 4.5 23 A 2.5 2.5 0 0 0 7 25.5 A 2.5 2.5 0 0 0 9.5 23 A 2.5 2.5 0 0 0 7 20.5 z M 15 20.5 A 2.5 2.5 0 0 0 12.5 23 A 2.5 2.5 0 0 0 15 25.5 A 2.5 2.5 0 0 0 17.5 23 A 2.5 2.5 0 0 0 15 20.5 z M 23 20.5 A 2.5 2.5 0 0 0 20.5 23 A 2.5 2.5 0 0 0 23 25.5 A 2.5 2.5 0 0 0 25.5 23 A 2.5 2.5 0 0 0 23 20.5 z" fill="#FFFFFF" />
                                                </svg> 
                                                <span class="fi-btn-label">
                                                    {{ __('filawidget::filawidget.Widgets') }}
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
        {{-- Include SortableJS from CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                var sortable = new Sortable(document.getElementById('sortable-widget-areas'), {
                    animation: 150,
                    ghostClass: 'bg-blue-100',
                    onEnd: function (evt) {
                        // Trigger the order update after sorting ends
                        @this.widgetAreasOrder = Array.from(document.querySelectorAll('.sortable-widget-area-item')).map(item => item.dataset.id);
                    }
                });
                
                let nbrWidgetAreas = {{ $nbrWidgetAreas}};

                for (var i = 1; i <= nbrWidgetAreas; i++) {
                    var sortable = new Sortable(document.getElementById('sortable-widget-' + i), {
                        animation: 150,
                        ghostClass: 'bg-blue-100',
                        onEnd: function (evt) {
                            // Get the sortable container's items for the current area
                            let container = evt.from;
                            let items = container.querySelectorAll('.sortable-widget-item');

                            // Update the widget order from the sorted items
                            @this.widgetsOrder = Array.from(items).map(item => item.dataset.id);
                        }
                    });
                }
            });
        </script>
    @else

    <div class="pb-4">

        @if (session('pageStatus'))
            <div class="p-3 mb-2 text-white rounded shadow" style="background: #19a5a1;">
                <div class="flex gap-4 justify-between">
                    <div>
                        {{ session('pageStatus') }}
                    </div>
                    <div wire:click="hideAlert" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
                            <path d="M4.7070312 3.2929688L3.2929688 4.7070312L10.585938 12L3.2929688 19.292969L4.7070312 20.707031L12 13.414062L19.292969 20.707031L20.707031 19.292969L13.414062 12L20.707031 4.7070312L19.292969 3.2929688L12 10.585938L4.7070312 3.2929688 z" fill="#FFFDFD" />
                        </svg>
                    </div>
                </div>
            </div>
        @endif

        <div class="fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between py-2 mb-2">
            <div>
                <h2 class="text-lg font-bold">{{ __('filawidget::filawidget.Pages with subpages') }}</h2>
                <small>{{ __('filawidget::filawidget.Change the order of pages and subpages just by using Drag-and-drop.') }}</small>
            </div>
            <div class="fi-ac gap-3 flex flex-wrap items-center justify-start shrink-0">
                <div class="p-2 rounded-full bg-primary-500">
                    <a href="/" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
                            <path d="M15 5C6 5 0.19726562 14.408203 0.19726562 14.408203L0.19726562 14.435547C0.082350414 14.598369 0 14.7857 0 15C0 15.192109 0.068085697 15.361256 0.16210938 15.513672L0.16210938 15.544922C0.16110937 15.544922 5 25 15 25C25 25 29.837891 15.544922 29.837891 15.544922L29.837891 15.513672C29.931914 15.361256 30 15.192109 30 15C30 14.7857 29.91765 14.598369 29.802734 14.435547L29.802734 14.408203C29.802734 14.408203 24 5 15 5 z M 15 8C18.866 8 22 11.134 22 15C22 18.866 18.866 22 15 22C11.134 22 8 18.866 8 15C8 11.134 11.134 8 15 8 z M 15 12C13.343 12 12 13.343 12 15C12 16.657 13.343 18 15 18C16.657 18 18 16.657 18 15C18 13.343 16.657 12 15 12 z" fill="#FFFFFF" />
                        </svg>
                    </a>
                </div>
                <div class="p-2 rounded-full" style="background-color: #2980b9;">
                    <a href="{{ route('filament.admin.resources.pages.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="25" height="25">
                            <path d="M24,4C12.972,4,4,12.972,4,24s8.972,20,20,20s20-8.972,20-20S35.028,4,24,4z M32.5,25.5h-7v7c0,0.829-0.672,1.5-1.5,1.5s-1.5-0.671-1.5-1.5v-7h-7c-0.828,0-1.5-0.671-1.5-1.5s0.672-1.5,1.5-1.5h7v-7c0-0.829,0.672-1.5,1.5-1.5s1.5,0.671,1.5,1.5v7h7c0.828,0,1.5,0.671,1.5,1.5S33.328,25.5,32.5,25.5z" fill="#FFFFFF" />
                        </svg>
                    </a>
                </div>
                <button wire:click="updatePageOrder" class="px-4 py-2 bg-primary text-white rounded hover:bg-blue-600" style="background: #19a5a1;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
                        <path d="M6 4C4.895 4 4 4.895 4 6L4 24C4 25.105 4.895 26 6 26L24 26C25.105 26 26 25.105 26 24L26 8L22 4L20 4L20 10C20 10.552 19.552 11 19 11L10 11C9.448 11 9 10.552 9 10L9 4L6 4 z M 16 4L16 9L18 9L18 4L16 4 z M 10 16L20 16C21.105 16 22 16.895 22 18L22 24L8 24L8 18C8 16.895 8.895 16 10 16 z" fill="#FFFDFD" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Container for sortable items --}}
        <div id="sortable-pages" class="space-y-4">
            @foreach ($pages as $key => $page)
                <div x-data="{ expanded: {{ $loop->first ? 'true' : 'false' }} }" id="sortable-container" class="sortable-page-item rounded  space-y-4" data-id="{{ $page->id }}">
                    <div class="fi-ta-header-toolbar flex items-center justify-between gap-x-4 px-4 py-4 sm:px-6" style="border-bottom: 1px solid #ddd;">
                        <div class="flex gap-2">
                            <div class="p-2 rounded-full" style="background-color: #16a085;">
                                <a href="{{ route('filament.admin.resources.pages.edit',$page->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="18" height="18">
                                        <path d="M4 4L4 24C4 25.1 4.89 26 6 26L14.980469 26L15.019531 26L17.140625 26L26 17.140625L26 4L4 4 z M 12 6L18 6C18.55 6 19 6.45 19 7C19 7.55 18.55 8 18 8L12 8C11.45 8 11 7.55 11 7C11 6.45 11.45 6 12 6 z M 28.230469 18C27.780469 18 27.330469 18.169531 26.980469 18.519531L26.460938 19.039062L28.960938 21.539062L29.480469 21.019531C30.170469 20.329531 30.170469 19.209531 29.480469 18.519531C29.140469 18.169531 28.680469 18 28.230469 18 z M 25.039062 20.460938L20.509766 25L19.509766 26L18.480469 27.029297L18 30L20.980469 29.529297L24.589844 25.910156L24.599609 25.910156L25.910156 24.589844L27.539062 22.960938L26 21.419922L25.039062 20.460938 z" fill="#FFFFFF" />
                                    </svg>
                                </a>
                            </div>
                            <div class="p-2 rounded-full" style="background-color: #2980b9;">
                                <a href="{{ route('filament.admin.resources.pages.create') }}?page_id={{ $page->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="18" height="18">
                                        <path d="M24,4C12.972,4,4,12.972,4,24s8.972,20,20,20s20-8.972,20-20S35.028,4,24,4z M32.5,25.5h-7v7c0,0.829-0.672,1.5-1.5,1.5s-1.5-0.671-1.5-1.5v-7h-7c-0.828,0-1.5-0.671-1.5-1.5s0.672-1.5,1.5-1.5h7v-7c0-0.829,0.672-1.5,1.5-1.5s1.5,0.671,1.5,1.5v7h7c0.828,0,1.5,0.671,1.5,1.5S33.328,25.5,32.5,25.5z" fill="#FFFFFF" />
                                    </svg>
                                </a>
                            </div>
                            <p style="line-height: 2;">{{ $page->title }} ({{ $page->children ? $page->children->count() : 0 }})</p>
                        </div>
                        <div @click="expanded = ! expanded" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                <path d="M7.121,17.121c-1.171,1.172-3.071,1.172-4.242,0c-1.172-1.171-1.172-3.071,0-4.242l7-7C10.465,5.293,11.232,5,12,5v7.243L7.121,17.121z" opacity=".35" />
                                <path d="M21.121,12.879C21.707,13.464,22,14.232,22,15s-0.293,1.536-0.879,2.121c-1.171,1.172-3.071,1.172-4.242,0L12,12.243V5c0.768,0,1.535,0.293,2.121,0.879L21.121,12.879z" />
                            </svg>
                        </div>
                    </div>
                    <div x-show="expanded" x-collapse id="sortable-page-{{ $key + 1 }}" class="space-y-4 px-2 pb-4">
                        @forelse ($page->children->sortBy('child_order') as $sub_page)
                            <div class="sortable-page-item  p-4 rounded cursor-move" data-id="{{ $sub_page->id }}" style="border: 1px dashed #000;">
                                <div class="flex gap-4 justify-between">
                                    <div class="flex gap-3">
                                        <div class="p-2 mr-2 rounded-full" style="background-color: #2c3e50;">
                                            <a href="{{ route('filament.admin.resources.pages.edit',$sub_page->id) }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="18" height="18">
                                                    <path d="M10.5 6C7.468 6 5 8.468 5 11.5L5 36C5 39.309 7.691 42 11 42L22.605469 42C22.858469 41.042 23.225516 39.759 23.728516 38L11 38C9.897 38 9 37.103 9 36L9 16L39 16L39 22.521484C39.427 22.340484 39.8615 22.188422 40.3125 22.107422C40.7065 22.036422 41.102859 21.992953 41.505859 22.001953C42.015859 22.001953 42.515 22.067641 43 22.181641L43 11.5C43 8.468 40.532 6 37.5 6L10.5 6 z M 13.5 20 A 1.50015 1.50015 0 1 0 13.5 23L15.5 23 A 1.50015 1.50015 0 1 0 15.5 20L13.5 20 z M 21.5 20C20.672 20 20 20.671 20 21.5C20 22.329 20.672 23 21.5 23L34.5 23C35.328 23 36 22.329 36 21.5C36 20.671 35.328 20 34.5 20L21.5 20 z M 41.498047 24C41.224047 24.001 40.946969 24.025172 40.667969 24.076172C39.783969 24.235172 38.939563 24.696156 38.226562 25.410156L26.427734 37.208984C26.070734 37.565984 25.807969 38.011141 25.667969 38.494141L24.097656 43.974609C24.025656 44.164609 23.993 44.365406 24 44.566406C24.013 44.929406 24.155594 45.288406 24.433594 45.566406C24.710594 45.843406 25.067688 45.986 25.429688 46C25.630688 46.007 25.834391 45.975344 26.025391 45.902344L31.505859 44.332031C31.988859 44.192031 32.431062 43.930266 32.789062 43.572266L44.589844 31.773438C45.303844 31.060437 45.764828 30.216031 45.923828 29.332031C45.973828 29.053031 45.997047 28.775953 45.998047 28.501953C46.001047 27.307953 45.540687 26.179312 44.679688 25.320312C43.820687 24.460313 42.692047 23.998 41.498047 24 z M 13.5 26 A 1.50015 1.50015 0 1 0 13.5 29L15.5 29 A 1.50015 1.50015 0 1 0 15.5 26L13.5 26 z M 21.5 26C20.672 26 20 26.671 20 27.5C20 28.329 20.672 29 21.5 29L31.808594 29L34.779297 26.027344C34.688297 26.010344 34.596 26 34.5 26L21.5 26 z M 13.5 32 A 1.50015 1.50015 0 1 0 13.5 35L15.5 35 A 1.50015 1.50015 0 1 0 15.5 32L13.5 32 z M 21.5 32C20.672 32 20 32.671 20 33.5C20 34.329 20.672 35 21.5 35L25.808594 35L28.808594 32L21.5 32 z" fill="#FFFFFF" />
                                                </svg>
                                            </a>
                                        </div>
                                        <p style="line-height: 2;">{{ $sub_page->title }}</p>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                                            <path d="M15.634,3.634l-3.069-3.069c-0.312-0.312-0.819-0.312-1.131,0L8.366,3.634C7.862,4.138,8.219,5,8.931,5h6.137 C15.781,5,16.138,4.138,15.634,3.634z" />
                                            <path d="M12,9c-0.828,0-1.5-0.671-1.5-1.5v-4C10.5,2.671,11.172,2,12,2s1.5,0.671,1.5,1.5v4C13.5,8.329,12.828,9,12,9z" />
                                            <path d="M8.366,20.366l3.069,3.069c0.312,0.312,0.819,0.312,1.131,0l3.069-3.069C16.138,19.862,15.781,19,15.069,19H8.931 C8.219,19,7.862,19.862,8.366,20.366z" />
                                            <path d="M12,22c-0.828,0-1.5-0.671-1.5-1.5v-4c0-0.829,0.672-1.5,1.5-1.5s1.5,0.671,1.5,1.5v4C13.5,21.329,12.828,22,12,22z" />
                                            <path d="M7.5,10.5H5V8.931c0-0.713-0.862-1.07-1.366-0.566l-3.069,3.069c-0.312,0.312-0.312,0.819,0,1.131 l3.069,3.069C4.138,16.138,5,15.781,5,15.069V13.5h2.5C8.328,13.5,9,12.829,9,12S8.328,10.5,7.5,10.5z" opacity=".35" />
                                            <path d="M23.434,11.434l-3.069-3.069C19.862,7.862,19,8.219,19,8.931V10.5h-2.5c-0.828,0-1.5,0.671-1.5,1.5 s0.672,1.5,1.5,1.5H19v1.569c0,0.713,0.862,1.07,1.366,0.566l3.069-3.069C23.747,12.253,23.747,11.747,23.434,11.434z" opacity=".35" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="fi-ta-empty-state px-6 py-12">
                                <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                                    <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                                        <svg class="fi-ta-empty-state-icon h-6 w-6 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                        </svg>        
                                    </div>
                            
                                    <h4 class="fi-ta-empty-state-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                        {{ __('filawidget::filawidget.No Pages') }}
                                    </h4>
                            
                                    <p class="fi-ta-empty-state-description text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ __('filawidget::filawidget.Create a Pages to get started.') }}
                                    </p>
                                    
                                    <div class="fi-ta-actions flex shrink-0 items-center gap-3 flex-wrap justify-center mt-6">
                                        <a href="{{ route('filament.admin.resources.pages.create') }}?page_id={{ $page->id }}" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">
                                            <svg class="fi-btn-icon transition duration-75 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path>
                                            </svg>      
                                            <span class="fi-btn-label">
                                                {{ __('filawidget::filawidget.Create New Pages') }}
                                            </span>
                                        </a>
                                        <a href="{{ route('filament.admin.resources.pages.index') }}" style="background: #19a5a1;" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">  
                                            <svg class="fi-btn-icon transition duration-75 h-5 w-5 text-white" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                <path d="M7 4.5 A 2.5 2.5 0 0 0 4.5 7 A 2.5 2.5 0 0 0 7 9.5 A 2.5 2.5 0 0 0 9.5 7 A 2.5 2.5 0 0 0 7 4.5 z M 15 4.5 A 2.5 2.5 0 0 0 12.5 7 A 2.5 2.5 0 0 0 15 9.5 A 2.5 2.5 0 0 0 17.5 7 A 2.5 2.5 0 0 0 15 4.5 z M 23 4.5 A 2.5 2.5 0 0 0 20.5 7 A 2.5 2.5 0 0 0 23 9.5 A 2.5 2.5 0 0 0 25.5 7 A 2.5 2.5 0 0 0 23 4.5 z M 7 12.5 A 2.5 2.5 0 0 0 4.5 15 A 2.5 2.5 0 0 0 7 17.5 A 2.5 2.5 0 0 0 9.5 15 A 2.5 2.5 0 0 0 7 12.5 z M 15 12.5 A 2.5 2.5 0 0 0 12.5 15 A 2.5 2.5 0 0 0 15 17.5 A 2.5 2.5 0 0 0 17.5 15 A 2.5 2.5 0 0 0 15 12.5 z M 23 12.5 A 2.5 2.5 0 0 0 20.5 15 A 2.5 2.5 0 0 0 23 17.5 A 2.5 2.5 0 0 0 25.5 15 A 2.5 2.5 0 0 0 23 12.5 z M 7 20.5 A 2.5 2.5 0 0 0 4.5 23 A 2.5 2.5 0 0 0 7 25.5 A 2.5 2.5 0 0 0 9.5 23 A 2.5 2.5 0 0 0 7 20.5 z M 15 20.5 A 2.5 2.5 0 0 0 12.5 23 A 2.5 2.5 0 0 0 15 25.5 A 2.5 2.5 0 0 0 17.5 23 A 2.5 2.5 0 0 0 15 20.5 z M 23 20.5 A 2.5 2.5 0 0 0 20.5 23 A 2.5 2.5 0 0 0 23 25.5 A 2.5 2.5 0 0 0 25.5 23 A 2.5 2.5 0 0 0 23 20.5 z" fill="#FFFFFF" />
                                            </svg> 
                                            <span class="fi-btn-label">
                                                {{ __('filawidget::filawidget.Pages') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    {{-- Include SortableJS from CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var sortable = new Sortable(document.getElementById('sortable-pages'), {
                animation: 150,
                ghostClass: 'bg-blue-100',
                onEnd: function (evt) {
                    // Trigger the order update after sorting ends
                    @this.pagesOrder = Array.from(document.querySelectorAll('.sortable-page-item')).map(item => item.dataset.id);
                }
            });

            let nbrPages = {{ $nbrPages}};

            for (var i = 1; i <= nbrPages; i++) {
                var sortable = new Sortable(document.getElementById('sortable-page-' + i), {
                    animation: 150,
                    ghostClass: 'bg-blue-100',
                    onEnd: function (evt) {
                        // Get the sortable container's items for the current area
                        let container = evt.from;
                        let items = container.querySelectorAll('.sortable-page-item');

                        // Update the widget order from the sorted items
                        @this.subPagesOrder = Array.from(items).map(item => item.dataset.id);
                    }
                });
            }
        });
    </script>
    @endif
</x-filament-panels::page>
