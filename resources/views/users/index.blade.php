<x-app title="Users List" color="green">
  <table class="border-collapse m-5 mx-auto md:w-4/5 sm:w-full">
    <thead class="text-left font-bold">
      <tr>
        <th class="pl-3 py-2 border border-solid bg-green-300">ID</th>
        <th class="pl-3 py-2 border border-solid bg-green-300">Avatar</th>
        <th class="pl-3 py-2 border border-solid bg-green-300">Name</th>
        <th class="pl-3 py-2 border border-solid bg-green-300">Username</th>
        <th class="pl-3 py-2 border border-solid bg-green-300">Role</th>
        <th class="pl-3 py-2 border border-solid bg-green-300">View Profile</th>
        @can('edit user roles')
        <th class="pl-3 py-2 border border-solid bg-green-300">Edit Role</th>
        @endcan
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr class="text-sm sm:text-base">
        <td class="pl-3 py-1 border border-solid even:bg-gray-200">
          {{ $user->id }}
        </td>
        <td class="pl-3 py-1 border border-solid even:bg-gray-200">
          <img src="{{ $user->avatar }}" alt="Avatar" width="60">
        </td>
        <td class="pl-3 py-1 border border-solid even:bg-gray-200">
          {{ $user->name() }}
        </td>
        <td class="pl-3 py-1 border border-solid even:bg-gray-200">
          {{ $user->username }}
        </td>
        <td class="pl-3 py-1 border border-solid even:bg-gray-200">
          {{ $user->getRoleNames()->first() }}
        </td>
        <td class="pl-3 py-1 border border-solid even:bg-gray-200">
          <a href="/profiles/{{ $user->username }}"
            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">View</a>
        </td>

        @can('updateRole', $user)
        @if( $user->id === 1)
        <td class="p-2 border border-solid even:bg-gray-200"></td>
        @else
        <td class="p-2 border border-solid even:bg-gray-200">
          <a href="/users/{{ $user->id }}/edit"
            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">EDIT</a>
        </td>
        @endif
        @endcan
      </tr>
      @endforeach
    </tbody>
  </table>
</x-app>