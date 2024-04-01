<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">
    @if (Auth::user()->modulo === 1)
    @elseif(Auth::user()->modulo === 2)
        <x-sidebar.dropdown title="Leads" :active="Str::startsWith(request()->route()->uri(), 'leads')">
            <x-slot name="icon">
                <x-heroicon-o-filter class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
            <x-sidebar.sublink title="Novos" href="{{ route('leads.index') }}" :active="request()->routeIs('leads.index')" />
        </x-sidebar.dropdown>
    @elseif(Auth::user()->modulo === 3)

    @elseif(Auth::user()->modulo === 4)
    @endif
    {{-- <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        Dummy Links
    </div>
    @php
        $links = array_fill(0, 20, '');
    @endphp
    @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach --}}
</x-perfect-scrollbar>
