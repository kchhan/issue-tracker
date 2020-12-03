<x-app title="Project #ID: {{ $project->id }}" color="pink">
    <div>
        <div>
            <h3>TITLE: {{ $project->title }}</h3>
        </div>
        <div>
            <p>DESCRIPTION: {{ $project->description }}</p>
        </div>
        <div>
            <p>PRIORITY: {{ $project->priority }}</p>
            <p>STATUS: {{ $project->status }}</p>
            <p>DUE ON: {{ $project->duedate }}</p>
            <p>CREATED AT: {{ $project->created_at }}</p>
            <p>UPDATED AT: {{ $project->updated_at }}</p>
        </div>
        <div>
            <h3>PROJECT MANAGER: {{ $manager->name() }}</h3>
            <ul>
                <h4>Assigned Developers</h4>
                @forelse($developers as $developer)
                <li>{{ $developer->name() }}</li>
                @empty
                <li>No Assigned Developers</li>
                @endforelse
            </ul>
        </div>
        <div>
            @can('update', $project)
            <a href="/projects/{{ $project->id }}/edit"
                class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">Edit Project</a>
            @endcan
        </div>
        <div>
            @can('update', $project)
            <form method="POST" action="/projects/{{ $project->id }}">
                @csrf @method("DELETE")
                <button type="submit" class="bg-red-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                    Delete Project
                </button>
            </form>
            @endcan
        </div>
    </div>
</x-app>