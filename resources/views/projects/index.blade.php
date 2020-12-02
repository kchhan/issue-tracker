<x-app title="Projects List" color="pink">
    <a class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2" href="/projects/create">New Project</a>

    <ul>
        @forelse($projects as $project)
        <li>
            <a href="/projects/{{ $project->id }}">
                {{ $project->title }}
            </a>
        </li>
        @empty
        <li>
            You have no projects
        </li>
        @endforelse
    </ul>
</x-app>