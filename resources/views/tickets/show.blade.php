<x-app title="Ticket #ID: {{ $ticket->id }}" color="orange">
    <section>
        <table class="border-collapse m-5 mx-auto w-full md:w-4/5 lg:w-3/5">
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Title</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->title }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Description</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->description }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Type</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->type }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Priority</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->priority }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Status</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->status }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Due Date</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->duedate }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Created At</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->created_at }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Updated At</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $ticket->updated_at }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Manager</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">
                    {{ $ticket->project->manager->name() }}
                    <a
                        href="/profiles/{{ $ticket->project->manager->username }}"
                        class="bg-blue-500 rounded-full shadow ml-2 py-2 px-4 text-white text-xs mr-2">
                        View Profile
                    </a>
                </td>
            </tr>
            @if ($ticket->developer)
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Developer</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">
                    {{ $ticket->developer->name() }}
                    <a
                        href="/profiles/{{ $ticket->developer->username }}"
                        class="bg-blue-500 rounded-full shadow ml-2 py-2 px-4 text-white text-xs mr-2">
                        View Profile
                    </a>
                </td>
            </tr>
            @else
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Developer</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">There is no assigned Developer</td>
            </tr>
            @endif
            @can('update', $ticket)
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Update</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">
                    <a href="/tickets/{{ $ticket->id }}/edit"
                        class="bg-yellow-500 rounded-full shadow inline-block my-4 py-2 px-3 text-white text-xs md:text-sm">
                        Edit ticket</a>
                </td>
            </tr>
            @endcan
        </table>
    </section>
</x-app>