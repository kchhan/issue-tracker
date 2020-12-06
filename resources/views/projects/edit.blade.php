<x-app title="Edit Project #ID: {{ $project->id }}" color="pink">
    <div class="container mx-auto inline-block">
        <form method="POST" action="/projects/{{ $project->id }}">
            @csrf
            @method("PATCH")

            <div class="inline">
                <label for="title" class="block font-bold mb-1 mx-4  text-gray-700">Title</label>
                <input type="text" name="title"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ old('title', $project->title) }}" required />
            </div>

            <div class="inline">
                <label for="description" class="block font-bold mb-1 mx-4 text-gray-700">Description</label>
                <textarea type="text" name="description"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2 min-h-1/2"
                    rows="10" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="inline">
                <label for="developers[]" class="block font-bold mb-1 mx-4 text-gray-700">Assigned Developers</label>
                <div class="flex flex-col">
                    @forelse ($developers as $developer)
                    <label class="inline-block mx-2">
                        <input type="checkbox" name="developers[]" class="mx-2" value="{{ $developer->id }}"
                            @if($project->developers->contains($developer->id)) checked
                        @endif>
                        {{ $developer->name() }}
                    </label>
                    @empty
                    <label>
                        <input type="checkbox" disabled>There are no developers
                    </label>
                    @endforelse
                </div>
            </div>

            <div class="inline">
                <label for="priority" class="block font-bold mb-1 mx-4 text-gray-700">Priority</label>
                <select name="priority"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $project->priority }}" required>
                    <option value="high" @if($project->priority === "high") selected @endif>
                        High
                    </option>
                    <option value="medium" @if($project->priority === "medium") selected @endif>
                        Medium
                    </option>
                    <option value="low" @if($project->priority === "low") selected @endif>
                        Low
                    </option>
                </select>
            </div>

            <div class="inline">
                <label for="status" class="block font-bold mb-1 mx-4 text-gray-700">Status</label>
                <select name="status"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $project->status }}" required>
                    <option value="assigned" @if($project->status === "assigned") selected @endif>
                        Assigned
                    </option>
                    <option value="in_progress" @if($project->status === "in_progress") selected @endif>
                        In Progress
                    </option>
                    <option value="submitted" @if($project->status === "submitted") selected @endif>
                        Submitted
                    </option>
                    <option value="completed" @if($project->status === "completed") selected @endif>
                        Completed
                    </option>
                </select>
            </div>

            <div class="inline">
                <label for="duedate" class="block text-sm font-bold mb-1 mx-4 text-gray-700">Due Date</label>
                <input type="datetime-local" name="duedate"
                    class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
                    value="{{ $duedate }}" required />
            </div>

            <div class="block">
                <button type="submit" class="bg-blue-500 rounded-lg mx-4 mt-2 px-4 py-1 text-white">
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