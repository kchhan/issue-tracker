<x-app title="Tickets List" color="orange">
    @can('create tickets')
    <a class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2" href="/tickets/create">New Ticket</a>
    @endcan

    <ul>
        @forelse($tickets as $ticket)
        <li>
            <a href="/tickets/{{ $ticket->id }}">
                {{ $ticket->title }}
            </a>
        </li>
        @empty
        <li>
            You have no tickets
        </li>
        @endforelse
    </ul>
</x-app>