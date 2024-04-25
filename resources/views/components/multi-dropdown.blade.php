@props(['id'])
<div id="{{ $id }}" class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
        {{ $slot }}
    </ul>
</div>
