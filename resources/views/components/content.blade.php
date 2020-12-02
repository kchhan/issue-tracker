<div class="flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
    <div class="bg-gray-800 pt-3">
        <div
            class="rounded-tl-3xl bg-gradient-to-r from-{{ $color ?: 'blue' }}-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h3 class="font-bold pl-2">{{ $title ?: '' }}</h3>
        </div>
    </div>
    <div class="m-3">
        {{ $slot }}
    </div>
</div>