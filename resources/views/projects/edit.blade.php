<x-app title="Edit Project #ID: {{ $project->id }}" color="pink">
  <form method="POST" action="/projects/{{ $project->id }}" class="m-2 p-2 mx-auto max-w-3xl bg-gray-200">
    @csrf
    @method("PATCH")

    <div class="inline">
      <label for="title" class="block font-bold mb-1 text-gray-700">Title</label>
      <input type="text" name="title" class="shadow appearance-none border rounded p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{ old('title', $project->title) }}" required />
    </div>

    <div class="inline">
      <label for="description" class="block font-bold mb-1 text-gray-700">Description</label>
      <textarea type="text" name="description" class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full min-h-1/2" rows="10" required>{{ old('description', $project->description) }}</textarea>
    </div>

    <div class="inline">
      <label for="developers[]" class="block font-bold mb-1 text-gray-700">Assigned Developers</label>
      <small class="mb-1 mx-6">If disabled, the developer has an outstanding ticket on the project and cannot
        be removed</small>
      <div class="flex flex-col">
        @forelse ($developers as $developer)
        <label class="inline-block mx-2">
          <input type="checkbox" name="developers[]" class="mx-2" value="{{ $developer->id }}" @if($project->developers->contains($developer->id)) checked
          @endif

          @foreach ($project->tickets as $ticket)
          @if($ticket->status !== 'Completed' && $ticket->developer_id === $developer->id)
          disabled
          @endif
          @endforeach
          >

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
      <label for="priority" class="block font-bold mb-1 text-gray-700">Priority</label>
      <select name="priority" class="shadow appearance-none border rounded p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{ $project->priority }}" required>
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
      <label for="status" class="block font-bold mb-1 text-gray-700">Status</label>
      <select name="status" class="shadow appearance-none border rounded p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{ $project->status }}" required>
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
      <label for="duedate" class="block text-sm font-bold mb-1 text-gray-700">Due Date</label>
      <input type="datetime-local" name="duedate" class="shadow appearance-none border rounded p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{ $duedate }}" required />
    </div>

    <div class="block">
      <button type="submit" class="bg-blue-500 rounded-lg mt-2 px-4 py-1 text-white text-center">
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
  <div class="flex align-items-center justify-center">
    @can('delete', $project)
    <form method="POST" action="/projects/{{ $project->id }}">
      @csrf
      @method("DELETE")
      <button type="submit" class="bg-red-500 rounded-lg mt-2 px-4 py-1 text-white">
        Delete Project
      </button>
    </form>
    @endcan
  </div>
</x-app>
