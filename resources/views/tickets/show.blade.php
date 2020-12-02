<x-app title="Ticket #ID: {{ $ticket->id }}"
    color="orange">
    <div>
        <div>
            <h3>TITLE: {{ $ticket->title }}</h3>
        </div>
        <div>
            <p>PROJECT: {{ $project->title }}</p>
            <p>DESCRIPTION: {{ $ticket->description }}</p>
        </div>
        <div>
            <p>TYPE: {{ $ticket->type }}</p>
            <p>PRIORITY: {{ $ticket->priority }}</p>
            <p>STATUS: {{ $ticket->status }}</p>
            <p>DUE ON: {{ $ticket->duedate }}</p>
            <p>CREATED AT: {{ $ticket->created_at }}</p>
            <p>UPDATED AT: {{ $ticket->updated_at }}</p>
        </div>
        <div>
            <p>DEVELOPER: {{ $developer->name() }}</p>
        </div>
        <div>
            @can('update')
                <a href="/tickets/{{ $ticket->id }}/edit"
                    class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">Edit ticket</a>
            @endcan
        </div>
        <div>
            @can('delete')
                <form method="POST"
                    action="/tickets/{{ $ticket->id }}">
                    @csrf @method("DELETE")
                    <button type="submit"
                        class="bg-red-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                        Delete ticket
                    </button>
                </form>
            @endcan
        </div>
    </div>
</x-app>
