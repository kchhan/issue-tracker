<x-app title="Edit Project #ID: {{ $project->id }}" color="pink">
    <div class="container mx-auto inline-block">
        <form method="POST" action="/projects/{{ $project->id }}">
            @csrf @method("PATCH")

            <div class="inline">
                <label
                    for="title"
                    class="block font-bold mb-1 mx-4  text-gray-700"
                    >Title</label
                >
                <input
                    type="text"
                    name="title"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ old('title', $project->title) }}"
                    required
                />
            </div>

            <div class="inline">
                <label
                    for="description"
                    class="block font-bold mb-1 mx-4 text-gray-700"
                    >Description</label
                >
                <textarea
                    type="text"
                    name="description"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2 min-h-1/2"
                    rows="10"
                    required
                    >{{ old('description', $project->description ) }}</textarea
                >
            </div>

            <div class="inline">
                <label
                    for="developers"
                    class="block font-bold mb-1 mx-4 text-gray-700"
                    >Assigned Developers</label
                >
                <select
                    name="developers[]"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ old('developers') }}"
                    multiple
                    required
                >
                    @foreach ($developers as $developer)
                    <option
                        value="{{ $developer->id }}"
                        >{{ $developer->name() }}</option
                    >
                    @endforeach
                </select>
            </div>

            <div class="inline">
                <label
                    for="type"
                    class="block font-bold mb-1 mx-4 text-gray-700"
                    >Type</label
                >
                <select
                    name="type"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $project->type }}"
                    required
                >
                    <option value="bug">Bug</option>
                    <option value="feature">Feature</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="inline">
                <label
                    for="priority"
                    class="block font-bold mb-1 mx-4 text-gray-700"
                    >Priority</label
                >
                <select
                    name="priority"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $project->priority }}"
                    required
                >
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>

            <div class="inline">
                <label
                    for="status"
                    class="block font-bold mb-1 mx-4 text-gray-700"
                    >Status</label
                >
                <select
                    name="status"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $project->status }}"
                    required
                >
                    <option value="assigned">Assigned</option>
                    <option value="in_progress">In Progress</option>
                    <option value="submitted">Submitted</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="inline">
                <label
                    for="due_on"
                    class="block text-sm font-bold mb-1 mx-4 text-gray-700"
                    >Due Date</label
                >
                <input
                    type="date"
                    name="due_on"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $project->due_on }}"
                    required
                />
            </div>

            <div class="block">
                <button
                    type="submit"
                    class="bg-blue-500 rounded-lg mx-4 mt-2 px-4 py-1 text-white"
                >
                    Submit
                </button>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger inline">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
    </div>
</x-app>