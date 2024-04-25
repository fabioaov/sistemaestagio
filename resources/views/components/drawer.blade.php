@props(['id'])
<div id="{{ $id }}" class="fixed right-0 top-0 z-40 h-screen w-4/12 translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-gray-800" tabindex="-1">
    {{ $slot }}
</div>
