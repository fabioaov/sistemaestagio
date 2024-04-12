<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Novos
            </h2>
        </div>
    </x-slot>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="flex flex-row gap-4">
            <div class="w-1/3 bg-gray-100 rounded p-4">
                <h2 class="text-lg font-bold mb-4">To Do</h2>
                <div class="bg-white rounded p-2 shadow">
                    <div class="bg-blue-200 p-2 rounded mb-2">Task 1</div>
                    <div class="bg-blue-200 p-2 rounded mb-2">Task 2</div>
                    <div class="bg-blue-200 p-2 rounded mb-2">Task 3</div>
                </div>
            </div>
            <div class="w-1/3 bg-gray-100 rounded p-4">
                <h2 class="text-lg font-bold mb-4">In Progress</h2>
                <div class="bg-white rounded p-2 shadow">
                    <div class="bg-yellow-200 p-2 rounded mb-2">Task 4</div>
                    <div class="bg-yellow-200 p-2 rounded mb-2">Task 5</div>
                </div>
            </div>
            <div class="w-1/3 bg-gray-100 rounded p-4">
                <h2 class="text-lg font-bold mb-4">Done</h2>
                <div class="bg-white rounded p-2 shadow">
                    <div class="bg-green-200 p-2 rounded mb-2">Task 6</div>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
@vite(['resources/js/alerta.js'])
