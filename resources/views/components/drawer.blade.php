@props(['id'])
<div id="{{ $id }}"
    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-4/12 dark:bg-gray-800"
    tabindex="-1">
    {{ $slot }}
</div>
