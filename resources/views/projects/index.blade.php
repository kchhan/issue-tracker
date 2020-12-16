<x-app title="Projects List" color="pink">
    <table class="border-collapse m-5 mx-auto md:w-4/5 sm:w-full">
        <thead class="text-left font-bold">
            <tr>
                <th class="p-2 border border-solid bg-red-300">ID</th>
                <th class="p-2 border border-solid bg-red-300">Title</th>
                <th class="p-2 border border-solid bg-red-300">View Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr class="text-sm sm:text-base">
                <td class="p-2 border border-solid even:bg-gray-200">{{ $project->id }}</td>
                <td class="p-2 border border-soild even:bg-gray-200 w-4/5">{{ $project->title }}</td>
                <td class="p-2 border border-solid even:bg-gray-200">
                    <a href="/projects/{{ $project->id }}"
                        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                        Details
                    </a>
                </td>

            </tr>
            @empty
            <tr>
                <td class="p-2 border border-solid even:bg-gray-200"></td>
                <td class="p-2 border border-solid">You have no projects</td>
                <td class="p-2 border border-solid even:bg-gray-200"></td>
            </tr>
            @endforelse
            <tr>
                <td></td>
                <td></td>
                <td>
                    @can('create projects')
                    <a class="bg-green-500 rounded-full shadow inline-block my-4 py-2 px-3 text-white text-xs md:text-sm"
                        href="/projects/create">New Project</a>
                    @endcan
                </td>
            </tr>
        </tbody>
    </table>

    <table class="border-collapse mx-auto m-5">
        <thead class="text-left font-bold">
          <tr>
            <th class="p-2 border border-solid bg-red-300">Your Assigned Projects</th>
            <th class="p-2 border border-solid bg-red-300">View Project</th>
          </tr>
        </thead>
        <tbody>
          @forelse (auth()->user()->projects as $project)
          <tr>
            <td class="p-2 border border-solid even:bg-gray-200">{{ $project->title }}</td>
            <td class="p-2 border border-solid even:bg-gray-200">
              <a href="/projects/{{ $project->id }}"
                class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                Details
              </a>
            </td>
          </tr>
          @empty
          <td class="p-2 border border-solid even:bg-gray-200">No assigned projects</td>
          <td class="p-2 border border-solid even:bg-gray-200"></td>
          @endforelse
        </tbody>
      </table>
</x-app>