<x-app title="Users List" color="green">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Username</th>
        <th>Role</th>
        <th>View Profile</th>
        @can('edit user roles')
        <th>Edit Role</th>
        @endcan
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td><img src="{{ $user->avatar }}" alt="Avatar" width="60"></td>
        <td>{{ $user->name() }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->getRoleNames()->first() }}</td>
        <td><a href="/profiles/{{ $user->username }}"
            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">View</a></td>
        @can('updateRole', $user)

        @if( $user->id === 1)
        <td></td>
        @else
        <td>
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