<div class="flex items-center sm:flex-col  from-blue-500 to-indigo-500 p-6 rounded-lg shadow-md">
    <!-- Left Side: Title and Description -->
    @if($filter == "widgets")
        <div class="flex-1 space-y-4">
            <h2 class="text-2xl  font-bold mb-2">{{ __('filawidget::filawidget.Managing dynamic content and layouts') }}</h2>
            <p class="text-sm">{{ __('filawidget::filawidget.Drag-and-drop interface to manage the order of widgets within each area, allowing for a fully customizable page layout without the need for coding.') }}</p>
            <div class="lg:flex gap-2 lg:mt-2 grid sm:flex-1 sm:auto-cols-fr gap-y-2">
                <a href="{{ route('filament.admin.resources.widgets.index') }}" class="px-4 text-sm text-white btn-sm p-2 rounded hover:bg-blue-600" style="background: #27ae60;">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20" height="20">
                            <path d="M15 27.121c-.256 0-.512-.098-.707-.293l-3.121-3.121c-.391-.391-.391-1.023 0-1.414l3.121-3.121c.391-.391 1.023-.391 1.414 0l3.121 3.121c.391.391.391 1.023 0 1.414l-3.121 3.121C15.512 27.023 15.256 27.121 15 27.121zM13.293 23L15 24.707 16.707 23 15 21.293 13.293 23zM7.939 22.061c-.256 0-.512-.098-.707-.293l-4.061-4.061c-.391-.391-.391-1.023 0-1.414l4.061-4.061c.391-.391 1.023-.391 1.414 0l4.061 4.061c.391.391.391 1.023 0 1.414l-4.061 4.061C8.451 21.963 8.195 22.061 7.939 22.061zM15 15c-.303 0-.607-.116-.838-.347L9.347 9.838c-.463-.463-.463-1.213 0-1.677l4.814-4.814c.463-.463 1.213-.463 1.677 0l4.814 4.814c.463.463.463 1.213 0 1.677l-4.814 4.814C15.607 14.884 15.303 15 15 15zM21.939 22.061c-.256 0-.512-.098-.707-.293l-4.061-4.061c-.391-.391-.391-1.023 0-1.414l4.061-4.061c.391-.391 1.023-.391 1.414 0l4.061 4.061c.391.391.391 1.023 0 1.414l-4.061 4.061C22.451 21.963 22.195 22.061 21.939 22.061z" fill="#FFFFFF" />
                        </svg>
                        {{ __('filawidget::filawidget.Widgets') }}
                    </div>
                </a>
                <a href="{{ route('filament.admin.resources.widget-areas.index') }}" class="px-4 text-sm text-white btn-sm p-2 rounded hover:bg-blue-600" style="background: #2980b9;">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" width="20" height="20">
                            <path d="M12.3125 0C12.011719 0 11.699219 -0.0117188 11.5 0.1875L0.5 8.6875C0.199219 8.988281 -0.0078125 9.289063 0.09375 9.6875C0.195313 10.085938 0.511719 10.398438 0.8125 10.5L4.6875 11.5L0.5 14.71875C0.203125 14.949219 0.0625 15.328125 0.136719 15.699219C0.207031 16.070313 0.480469 16.367188 0.84375 16.46875L4.71875 17.46875L0.5 20.71875C0.203125 20.949219 0.0625 21.328125 0.136719 21.699219C0.207031 22.070313 0.480469 22.367188 0.84375 22.46875L14.25 25.96875C14.585938 26.054688 14.9375 25.957031 15.1875 25.71875L25.6875 15.9375C25.96875 15.675781 26.074219 15.277344 25.960938 14.910156C25.847656 14.546875 25.535156 14.277344 25.15625 14.21875L21.71875 13.65625L25.6875 9.9375C25.96875 9.675781 26.074219 9.277344 25.960938 8.910156C25.847656 8.546875 25.535156 8.277344 25.15625 8.21875L21.8125 7.625L25.8125 3.90625C26.011719 3.707031 26.101563 3.304688 26 2.90625C25.898438 2.507813 25.585938 2.289063 25.1875 2.1875 Z M 19.96875 9.34375L22.84375 9.84375L14.21875 17.90625L3.3125 15.0625L7.125 12.125L14.3125 14L14.59375 14C14.894531 14 15.113281 13.886719 15.3125 13.6875 Z M 19.875 15.34375L22.84375 15.84375L14.21875 23.90625L3.34375 21.0625L7.1875 18.125L14.25 19.96875C14.585938 20.054688 14.9375 19.957031 15.1875 19.71875Z" fill="#FFFFFF" />
                        </svg>
                        {{ __('filawidget::filawidget.Widget Areas') }}
                    </div>
                </a>
                <a href="{{ route('filament.admin.resources.widget-fields.index') }}" class="px-4 text-sm text-white btn-sm p-2 rounded hover:bg-blue-600" style="background: #8e44ad;">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                            <path d="M23.970703 5.9726562 A 2.0002 2.0002 0 0 0 22 8L22 15.171875L20.414062 13.585938 A 2.0002 2.0002 0 1 0 17.585938 16.414062L22.585938 21.414062 A 2.0002 2.0002 0 0 0 25.414062 21.414062L30.414062 16.414062 A 2.0002 2.0002 0 1 0 27.585938 13.585938L26 15.171875L26 8 A 2.0002 2.0002 0 0 0 23.970703 5.9726562 z M 8 16 A 2.0002 2.0002 0 1 0 8 20L11 20C12.127968 20 13 20.872032 13 22L13 26.171875L11.414062 24.585938 A 2.0002 2.0002 0 0 0 9.9785156 23.980469 A 2.0002 2.0002 0 0 0 8.5859375 27.414062L13.585938 32.414062 A 2.0002 2.0002 0 0 0 16.414062 32.414062L21.414062 27.414062 A 2.0002 2.0002 0 1 0 18.585938 24.585938L17 26.171875L17 22C17 18.709968 14.290032 16 11 16L8 16 z M 37 16C33.709968 16 31 18.709968 31 22L31 26.171875L29.414062 24.585938 A 2.0002 2.0002 0 0 0 27.978516 23.980469 A 2.0002 2.0002 0 0 0 26.585938 27.414062L31.585938 32.414062 A 2.0002 2.0002 0 0 0 34.414062 32.414062L39.414062 27.414062 A 2.0002 2.0002 0 1 0 36.585938 24.585938L35 26.171875L35 22C35 20.872032 35.872032 20 37 20L40 20 A 2.0002 2.0002 0 1 0 40 16L37 16 z M 7.9707031 31.972656 A 2.0002 2.0002 0 0 0 6 34L6 36C6 39.290032 8.7099679 42 12 42L36 42C39.290032 42 42 39.290032 42 36L42 34 A 2.0002 2.0002 0 1 0 38 34L38 36C38 37.127968 37.127968 38 36 38L12 38C10.872032 38 10 37.127968 10 36L10 34 A 2.0002 2.0002 0 0 0 7.9707031 31.972656 z" fill="#FFFFFF" />
                        </svg>
                        {{ __('filawidget::filawidget.Fields') }}
                    </div>
                </a>
                <a href="{{ route('filament.admin.resources.widget-types.index') }}" class="px-4 text-sm text-white btn-sm p-2 rounded hover:bg-blue-600" style="background: #2c3e50;">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                            <path d="M14 5C9.029 5 5 9.029 5 14L5 36C5 40.971 9.029 45 14 45L36 45C40.971 45 45 40.971 45 36L45 14C45 9.029 40.971 5 36 5L14 5 z M 17.363281 10L32.636719 10C36.696719 10 40 13.302281 40 17.363281L40 32.636719C40 36.697719 36.697719 40 32.636719 40L17.363281 40C13.302281 40 10 36.697719 10 32.636719L10 17.363281C10 13.302281 13.302281 10 17.363281 10 z M 17.363281 13C14.953281 13 13 14.953281 13 17.363281L13 32.636719C13 35.045719 14.953281 37 17.363281 37L32.636719 37C35.045719 37 37 35.046719 37 32.636719L37 17.363281C37 14.953281 35.046719 13 32.636719 13L17.363281 13 z" fill="#FFFFFF" />
                        </svg>
                        {{ __('filawidget::filawidget.Widget Types') }}
                    </div>
                </a>
            </div>
        </div>
    @elseif($filter == "pages")
        <div class="flex-1 space-y-4">
            <h2 class="text-2xl font-bold mb-2">{{ __('filawidget::filawidget.Managing pages and subpages') }}</h2>
            <p class="text-sm">{{ __('filawidget::filawidget.Drag-and-drop interface to manage the order of managing page and subpages, allowing for a fully customizable page layout without the need for coding.') }}</p>
        </div>
    @else
        <div class="flex-1 space-y-4">
            <h2 class="text-2xl font-bold mb-2">{{ __('filawidget::filawidget.Preview areas and widgets') }}</h2>
            <p class="text-sm">{{ __('filawidget::filawidget.Drag-and-drop interface to manage the order of widgets within each area, allowing for a fully customizable page layout without the need for coding.') }}</p>
        </div>
    @endif
    
    <!-- Right Side: Image -->
    <div class="flex-shrink-0">
        <div class="relative overflow-hidden bg-white rounded-full w-24 h-24 p-2 shadow-lg">
            <div class="w-full h-full object-cover rounded-full m-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="80" height="80">
                    <linearGradient id="3hRsBrOrYAqussVluy7dra" x1="3.998" x2="18.526" y1="-1929.146" y2="-1929.146" gradientTransform="matrix(1 0 0 -1 .482 -1892.593)" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#fed100" />
                    <stop offset="1" stop-color="#e36001" />
                    </linearGradient>
                    <path fill="url(#3hRsBrOrYAqussVluy7dra)" d="M5.117,43c-0.539,0.017-0.847-0.641-0.475-1.034c1.681-1.774,2.861-4.865,3.47-6.9 c0.875-2.927,3.188-5.92,7.949-4.669l1.433,0.093l1.23,1.84c0,0,0.283,0.905,0.283,2.965C19.008,40.751,13.047,42.748,5.117,43z" />
                    <linearGradient id="3hRsBrOrYAqussVluy7drb" x1="21.517" x2="21.869" y1="-1919.321" y2="-1925.338" gradientTransform="matrix(1 0 0 -1 .482 -1892.593)" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#c3cdd9" />
                    <stop offset="1" stop-color="#9fa7b0" />
                    </linearGradient>
                    <path fill="url(#3hRsBrOrYAqussVluy7drb)" d="M28.079,25.419c-2.828,2.851-4.243,4.277-9.192,7.84l-2.828-2.851 c3.536-4.989,4.95-6.415,7.778-9.266L28.079,25.419z" />
                    <linearGradient id="3hRsBrOrYAqussVluy7drc" x1="32.64" x2="33.248" y1="-1900.954" y2="-1921.282" gradientTransform="matrix(1 0 0 -1 .482 -1892.593)" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#f44f5a" />
                    <stop offset=".443" stop-color="#ee3d4a" />
                    <stop offset="1" stop-color="#e52030" />
                    </linearGradient>
                    <path fill="url(#3hRsBrOrYAqussVluy7drc)" d="M42.194,6.59c-0.781-0.786-2.048-0.786-2.829,0c-6.101,5.555-11.286,10.276-15.529,14.553 l4.243,4.277c4.243-4.277,8.762-9.688,14.115-15.978C42.974,8.654,42.974,7.377,42.194,6.59z" />
                    <path fill="#c94f60" d="M10.067,5.417l-3.65,3.651c-0.556,0.555-0.556,1.459,0,2.015l1.72,1.718l5.664-5.664l-1.718-1.72 C11.526,4.861,10.625,4.861,10.067,5.417" />
                    <path fill="#f0f0f0" d="M36.43,41.095L44,43l-1.906-7.571l-6.567-0.794L36.43,41.095z" />
                    <path fill="#33c481" d="M18.632,11.968l23.461,23.46l-5.665,5.665l-23.461-23.46L18.632,11.968z" />
                    <linearGradient id="3hRsBrOrYAqussVluy7drd" x1="105.613" x2="105.613" y1="-1830.494" y2="-1840.921" gradientTransform="matrix(0 -1 -1 0 -1822 118)" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#dedede" />
                    <stop offset="1" stop-color="#d6d6d6" />
                    </linearGradient>
                    <path fill="url(#3hRsBrOrYAqussVluy7drd)" d="M12.968,17.637l-4.834-4.832l5.664-5.668l4.834,4.832L12.968,17.637z" />
                    <path fill="#787878" d="M40.172,42.035L44,43l-0.965-3.827L40.172,42.035z" />
                </svg>
            </div>
        </div>
    </div>
</div>