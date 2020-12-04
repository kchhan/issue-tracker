<x-app title="Profile ID#{{ $user->id }}" color="yellow">
  <div>
    <div>
      <p>Avatar: <img src="{{ $user->avatar }}" alt="User's Avatar" width="100"></p>
      <p>Name: {{ $user->name() }}</p>
      <p>Username: {{ $user->username }}</p>
      <p>Email: {{ $user->email }}</p>
      <ul>
        <p>Assigned Projects</p>
        @forelse($projects as $project)
        <li>
          <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
        </li>
        @empty
        <li>Not assigned to any projects</li>
        @endforelse

      </ul>
      <ul>
        <p>Assigned Tickets</p>
        @forelse($tickets as $ticket)
        <li>
          <a href="/tickets/{{ $ticket->id }}">{{ $ticket->title }}</a>
        </li>
        @empty
        <li>Not assigned any tickets</li>
        @endforelse

      </ul>
    </div>
    <div>
      @can('updateProfile', $user)
      <a href="/profiles/{{ $user->username }}/edit"
        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">Edit user</a>
      @endcan
    </div>
  </div>
</x-app>