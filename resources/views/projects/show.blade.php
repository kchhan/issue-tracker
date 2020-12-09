<x-app title="Project #ID: {{ $project->id }}" color="pink">
    <section>
        <table class="border-collapse m-5 mx-auto w-full md:w-4/5 lg:w-3/5">
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Title</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->title }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Description</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->description }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Priority</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->priority }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Status</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->status }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Due Date</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->duedate }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Created At</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->created_at }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Updated At</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $project->updated_at }}</td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Manager</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">
                    {{ $project->manager->name() }} 
                    <a
                        href="/profiles/{{ $project->manager->username }}"
                        class="bg-blue-500 rounded-full shadow ml-2 py-2 px-4 text-white text-xs mr-2">
                        View Profile
                    </a>
                </td>
            </tr>
            <tr class="text-left">
                <th class="px-4 py-2 border border-solid bg-red-300 font-bold">Update</th>
                <td class="px-4 py-2 border border-solid even:bg-gray-200">
                    <a href="/projects/{{ $project->id }}/edit"
                        class="bg-yellow-500 rounded-full shadow inline-block my-4 py-2 px-3 text-white text-xs md:text-sm">
                        Edit Project</a>
                </td>
            </tr>
        </table>
    </section>

    <section class="flex flex-col lg:flex-row mx-auto w-full lg:w-4/5">
        <table class="border-collapse m-5 mx-auto">
            <thead class="text-left font-bold">
                <tr>
                    <th class="p-2 border border-solid bg-red-300">Assigned Developers</th>
                    <th class="p-2 border border-solid bg-red-300">View Profile</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($project->developers as $developer)
                <tr>
                    <td class="p-2 border border-solid even:bg-gray-200">{{ $developer->name() }}</td>
                    <td class="p-2 border border-solid even:bg-gray-200">
                        <a href="/profiles/{{ $developer->username }}"
                            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="p-2 border border-solid even:bg-gray-200">There are no assigned developers</td>
                    <td class="p-2 border border-solid even:bg-gray-200"></td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <table class="border-collapse m-5 mx-auto">
            <thead class="text-left font-bold">
                <tr>
                    <th class="p-2 border border-solid bg-red-300">Ticket ID</th>
                    <th class="p-2 border border-solid bg-red-300">Ticket Title</th>
                    <th class="p-2 border border-solid bg-red-300">Ticket Developer</th>
                    <th class="p-2 border border-solid bg-red-300">View Ticket</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($project->tickets as $ticket)
                <tr>
                    <td class="p-2 border border-solid even:bg-gray-200">{{ $ticket->id }}</td>
                    <td class="p-2 border border-solid even:bg-gray-200">{{ $ticket->title }}</td>
                    <td class="p-2 border border-solid even:bg-gray-200">{{ $ticket->developer->name() }}</td>
                    <td class="p-2 border border-solid even:bg-gray-200">
                        <a href="/tickets/{{ $ticket->id }}"
                            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                            View
                        </a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td class="p-2 border border-solid even:bg-gray-200"></td>
                    <td class="p-2 border border-solid even:bg-gray-200">
                        There are no tickets
                    </td>
                    <td class="p-2 border border-solid even:bg-gray-200"></td>
                    <td class="p-2 border border-solid even:bg-gray-200"></td>
                </tr>

                @endforelse
                <tr>
                    <td></td>
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
    </section>
</x-app>