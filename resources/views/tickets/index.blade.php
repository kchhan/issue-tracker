<x-app title="Tickets List" color="orange">
    <table class="border-collapse m-5 mx-auto md:w-4/5 sm:w-full">
        <thead class="text-left font-bold">
            <tr>
                <th class="p-2 border border-solid bg-orange-300">ID</th>
                <th class="p-2 border border-solid bg-orange-300">Title</th>
                <th class="p-2 border border-solid bg-orange-300">View Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr class="text-sm sm:text-base">
                <td class="p-2 border border-solid even:bg-gray-200">{{ $ticket->id }}</td>
                <td class="p-2 border border-soild even:bg-gray-200 w-4/5">{{ $ticket->title }}</td>
                <td class="p-2 border border-solid even:bg-gray-200">
                    <a href="/tickets/{{ $ticket->id }}"
                        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                        Details
                    </a>
                </td>

            </tr>
            @empty
            <tr>
                <td class="p-2 border border-solid even:bg-gray-200"></td>
                <td class="p-2 border border-solid">You have no tickets</td>
                <td class="p-2 border border-solid even:bg-gray-200"></td>
            </tr>
            @endforelse
            <tr>
                <td></td>
                <td></td>
                <td>
                    @can('create tickets')
                    <a class="bg-green-500 rounded-full shadow inline-block my-4 py-2 px-3 text-white text-xs md:text-sm"
                        href="/tickets/create">New Ticket</a>
                    @endcan
                </td>
            </tr>
        </tbody>
    </table>
</x-app>