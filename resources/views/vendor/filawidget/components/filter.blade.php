<div class="fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-3">
    <div>
        <nav class="fi-breadcrumbs mb-2 hidden sm:block">
            <ol class="fi-breadcrumbs-list flex flex-wrap items-center gap-x-2">
                <li class="fi-breadcrumbs-item flex gap-x-2">
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 dark:text-gray-400 transition duration-75 hover:text-gray-700 dark:hover:text-gray-200">
                        {{ __('filawidget::filawidget.Dashboard') }}
                    </a>
                </li>
                <li class="fi-breadcrumbs-item flex gap-x-2">
                    <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 rtl:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('filawidget::filawidget.Appearance') }}
                    </span>
                </li>
                <li class="fi-breadcrumbs-item flex gap-x-2">
                    <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 rtl:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 dark:text-gray-400">
                        @if(request()->query('filter') === 'pages')
                            {{ __('filawidget::filawidget.Pages') }}
                        @elseif(request()->query('filter') === 'widgets')
                            {{ __('filawidget::filawidget.Widgets') }}
                        @elseif(request()->query('filter') === 'preview')
                            {{ __('filawidget::filawidget.Preview') }}
                        @else
                            {{ __('filawidget::filawidget.Widgets') }}
                        @endif
                    </span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="flex justify-end space-x-4 mb-4 lg:mx-2 lg:px-2 gap-2">
        <a href="{{ request()->query('filter') === 'preview' ? '#' : '?filter=preview' }}" 
           @class([
            'text-white rounded w-full lg:px-4 py-2',
            'bg-selected' => (request()->query('filter') === 'preview' || !request()->has('filter')),
            'bg-default' => !(request()->query('filter') === 'preview' || !request()->has('filter')),
           ])
           >
            <div class="flex justify-between px-2 gap-2 text-sm">
                @if(request()->query('filter') === 'preview')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                        <path d="M36.5,6h-25C8.468,6,6,8.468,6,11.5v25c0,3.032,2.468,5.5,5.5,5.5h25c3.032,0,5.5-2.468,5.5-5.5v-25C42,8.468,39.532,6,36.5,6z M35.561,18.561l-14,14C21.268,32.854,20.884,33,20.5,33s-0.768-0.146-1.061-0.439l-6-6c-0.586-0.586-0.586-1.535,0-2.121s1.535-0.586,2.121,0l4.939,4.939l12.939-12.939c0.586-0.586,1.535-0.586,2.121,0S36.146,17.975,35.561,18.561z" fill="#FFFFFF" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20" height="20">
                        <path d="M15 5C6 5 0.19726562 14.408203 0.19726562 14.408203L0.19726562 14.435547C0.082350414 14.598369 0 14.7857 0 15C0 15.192109 0.068085697 15.361256 0.16210938 15.513672L0.16210938 15.544922C0.16110937 15.544922 5 25 15 25C25 25 29.837891 15.544922 29.837891 15.544922L29.837891 15.513672C29.931914 15.361256 30 15.192109 30 15C30 14.7857 29.91765 14.598369 29.802734 14.435547L29.802734 14.408203C29.802734 14.408203 24 5 15 5 z M 15 8C18.866 8 22 11.134 22 15C22 18.866 18.866 22 15 22C11.134 22 8 18.866 8 15C8 11.134 11.134 8 15 8 z M 15 12C13.343 12 12 13.343 12 15C12 16.657 13.343 18 15 18C16.657 18 18 16.657 18 15C18 13.343 16.657 12 15 12 z" fill="#FFFFFF" />
                    </svg>
                @endif
                {{ __('filawidget::filawidget.Preview') }}
            </div>
        </a>
        <a href="{{ request()->query('filter') === 'widgets' ? '#' : '?filter=widgets' }}" 
           @class([
            'text-white rounded w-full lg:px-4 py-2',
            'bg-selected' => (request()->query('filter') === 'widgets' || !request()->has('filter')),
            'bg-default' => !(request()->query('filter') === 'widgets' || !request()->has('filter')),
           ])
           >
           <div class="flex justify-between px-2 gap-2 text-sm">
                @if(request()->query('filter') === 'widgets')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                        <path d="M36.5,6h-25C8.468,6,6,8.468,6,11.5v25c0,3.032,2.468,5.5,5.5,5.5h25c3.032,0,5.5-2.468,5.5-5.5v-25C42,8.468,39.532,6,36.5,6z M35.561,18.561l-14,14C21.268,32.854,20.884,33,20.5,33s-0.768-0.146-1.061-0.439l-6-6c-0.586-0.586-0.586-1.535,0-2.121s1.535-0.586,2.121,0l4.939,4.939l12.939-12.939c0.586-0.586,1.535-0.586,2.121,0S36.146,17.975,35.561,18.561z" fill="#FFFFFF" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20" height="20">
                        <path d="M15 27.121c-.256 0-.512-.098-.707-.293l-3.121-3.121c-.391-.391-.391-1.023 0-1.414l3.121-3.121c.391-.391 1.023-.391 1.414 0l3.121 3.121c.391.391.391 1.023 0 1.414l-3.121 3.121C15.512 27.023 15.256 27.121 15 27.121zM13.293 23L15 24.707 16.707 23 15 21.293 13.293 23zM7.939 22.061c-.256 0-.512-.098-.707-.293l-4.061-4.061c-.391-.391-.391-1.023 0-1.414l4.061-4.061c.391-.391 1.023-.391 1.414 0l4.061 4.061c.391.391.391 1.023 0 1.414l-4.061 4.061C8.451 21.963 8.195 22.061 7.939 22.061zM15 15c-.303 0-.607-.116-.838-.347L9.347 9.838c-.463-.463-.463-1.213 0-1.677l4.814-4.814c.463-.463 1.213-.463 1.677 0l4.814 4.814c.463.463.463 1.213 0 1.677l-4.814 4.814C15.607 14.884 15.303 15 15 15zM21.939 22.061c-.256 0-.512-.098-.707-.293l-4.061-4.061c-.391-.391-.391-1.023 0-1.414l4.061-4.061c.391-.391 1.023-.391 1.414 0l4.061 4.061c.391.391.391 1.023 0 1.414l-4.061 4.061C22.451 21.963 22.195 22.061 21.939 22.061z" fill="#FFFFFF" />
                    </svg>
                @endif
                {{ __('filawidget::filawidget.Widgets') }}
            </div>
        </a>
        <a href="{{ request()->query('filter') === 'pages' ? '#' : '?filter=pages' }}" 
           @class([
            'text-white rounded w-full lg:px-4 py-2',
            'bg-selected' => (request()->query('filter') === 'pages'),
            'bg-default' => !request()->has('filter') || request()->query('filter') !== 'pages',
            ])
           >
           <div class="flex justify-between px-2 gap-2 text-sm">
                @if(request()->query('filter') === 'pages')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                        <path d="M36.5,6h-25C8.468,6,6,8.468,6,11.5v25c0,3.032,2.468,5.5,5.5,5.5h25c3.032,0,5.5-2.468,5.5-5.5v-25C42,8.468,39.532,6,36.5,6z M35.561,18.561l-14,14C21.268,32.854,20.884,33,20.5,33s-0.768-0.146-1.061-0.439l-6-6c-0.586-0.586-0.586-1.535,0-2.121s1.535-0.586,2.121,0l4.939,4.939l12.939-12.939c0.586-0.586,1.535-0.586,2.121,0S36.146,17.975,35.561,18.561z" fill="#FFFFFF" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="20" height="20">
                        <path d="M30.398438 2L7 2L7 48L43 48L43 15 Z M 15 12L28 12L28 14L15 14 Z M 18 36L15 36L15 34L18 34 Z M 18 30L15 30L15 28L18 28 Z M 18 24L15 24L15 22L18 22 Z M 35 36L22 36L22 34L35 34 Z M 35 30L22 30L22 28L35 28 Z M 35 24L22 24L22 22L35 22 Z M 30 15L30 4.398438L40.601563 15Z" fill="#FFFFFF" />
                    </svg>
                @endif
                {{ __('filawidget::filawidget.Pages') }}
            </div>
        </a>
    </div>
</div>

<style>
.bg-selected {
    background-color: #16a085;
}
.bg-default {
    background-color: #34495e;
}
</style>