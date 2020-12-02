<x-master>
    <x-navbar></x-navbar>

    <div class="flex flex-col md:flex-row">
        <x-sidebar></x-sidebar>

        <x-content :title="$title" :color="$color">
            {{ $slot }}
        </x-content>
    </div>
</x-master>