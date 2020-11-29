<x-app title="Create New Project" color="pink">
    <div class="container mx-auto inline-block">
        <form method="POST" action="/projects">
            @csrf

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
                    value="{{ old('title') }}"
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
                    value="{{ old('description') }}"
                    required
                ></textarea>
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
                    for="duedate"
                    class="block text-sm font-bold mb-1 mx-4 text-gray-700"
                    >Due Date</label
                >
                <input
                    type="datetime-local"
                    name="duedate"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ old('duedate') }}"
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
