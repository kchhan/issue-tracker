<x-app title="Profile ID#{{ $user->id }}" color="yellow">
  <section>
    <table class="border-collapse m-5 mx-auto w-full sm:w-4/5 md:w-3/5 lg:w-2/5">
      <tr class="text-left">
        <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Avatar</th>
        <td class="px-4 py-2 border border-solid even:bg-gray-200"> <img src="{{ $user->avatar }}" alt="User's Avatar"
            width="100"></td>
      </tr>
      <tr class="text-left">
        <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Name</th>
        <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $user->name() }}</td>
      </tr>
      <tr class="text-left">
        <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Username</th>
        <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $user->username }}</td>
      </tr>
      <tr class="text-left">
        <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Email</th>
        <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $user->email }}</td>
      </tr>
      <tr class="text-left">
        <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">User Since</th>
        <td class="px-4 py-2 border border-solid even:bg-gray-200">{{ $user->created_at }}</td>
      </tr>
      @can('updateProfile', $user)
      <tr class="text-left">
        <th class="px-4 py-2 border border-solid bg-orange-300 font-bold">Update</th>
        <td class="px-4 py-2 border border-solid even:bg-gray-200">
          <a href="/profiles/{{ $user->username }}/edit"
            class="bg-yellow-500 rounded-full shadow inline-block my-4 py-2 px-3 text-white text-xs md:text-sm">
            Edit Profile
          </a>
        </td>
      </tr>
      @endcan
    </table>
  </section>

  {{-- table for super_admins, admins, and managers --}}
  <section>
    @if($user->hasAnyRole(['super_admin', 'admin', 'manager']))
    <table class="border-collapse m-5 mx-auto w-full sm:w-4/5 md:w-3/5 lg:w-2/5">
      <thead class="text-left font-bold">
        <tr>
          <th class="p-2 border border-solid bg-orange-300">Projects to Manage</th>
          <th class="p-2 border border-solid bg-orange-300">View Project</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
        <tr>
          <td class="p-2 border border-solid even:bg-gray-200">{{ $project->title }}</td>
          <td class="p-2 border border-solid even:bg-gray-200">
            <a href="/projects/{{ $project->id }}"
              class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">View
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td class="p-2 border border-solid even:bg-gray-200">No projects</td>
          <td class="p-2 border border-solid even:bg-gray-200"></td>
        </tr>

        @endforelse
      </tbody>
    </table>

    @else
    {{-- project and ticket tables for developers --}}
    <div class="flex flex-col lg:flex-row mx-auto w-full lg:w-4/5">
      <table class="border-collapse mx-auto m-5">
        <thead class="text-left font-bold">
          <tr>
            <th class="p-2 border border-solid bg-orange-300">Assigned Projects</th>
            <th class="p-2 border border-solid bg-orange-300">View Project</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($user->projects as $project)
          <tr>
            <td class="p-2 border border-solid even:bg-gray-200">{{ $project->title }}</td>
            <td class="p-2 border border-solid even:bg-gray-200">
              <a href="/projects/{{ $project->id }}"
                class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                View
              </a>
            </td>
          </tr>
          @empty
          <td class="p-2 border border-solid even:bg-gray-200">No assigned projects</td>
          <td class="p-2 border border-solid even:bg-gray-200"></td>
          @endforelse
        </tbody>
      </table>

      <table class="border-collapse mx-auto m-5">
        <thead class="text-left font-bold">
          <tr>
            <th class="p-2 border border-solid bg-orange-300">Assigned Tickets</th>
            <th class="p-2 border border-solid bg-orange-300">View Ticket</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($user->tickets as $ticket)
          <tr>
            <td class="p-2 border border-solid even:bg-gray-200">{{ $ticket->title }}</td>
            <td class="p-2 border border-solid even:bg-gray-200">
              <a href="/tickets/{{ $ticket->id }}"
                class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                View
              </a>
            </td>
          </tr>
          @empty
          <td class="p-2 border border-solid even:bg-gray-200">No assigned tickets</td>
          <td class="p-2 border border-solid even:bg-gray-200"></td>
          @endforelse
        </tbody>
      </table>
    </div>
    @endif

  </section>
</x-app>