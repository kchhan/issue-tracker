<x-app title="Users List" color="green">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Username</th>
        <th>Role</th>
        @can('update')
        <th>Edit</th>
        @endcan
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->avatar }}</td>
        <td>{{ $user->name() }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->getRoleNames()->first() }}</td>
        @can('update')
        <td>
          <a href="/users/{{ $user->id }}/edit">EDIT USER ROLE</a>
        </td>
        @endcan
      </tr>
      @endforeach
    </tbody>
  </table>
</x-app>