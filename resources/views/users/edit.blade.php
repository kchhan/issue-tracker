<x-app title="Edit User ID#{{ $user->id }}" color="green">
  <form method="POST" action="/users/{{ $user->id }}" class="m-2 p-2 mx-auto max-w-md bg-gray-200">
    @csrf
    @method("PATCH")

    <div class="inline">
      <label for="role" class="block font-bold mb-1 text-gray-700">User Role</label>
      <select name="role"
        class="shadow appearance-none border rounded p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
        value="{{ old('role') }}" required>
        @foreach ($roles as $role)
        <option value="{{ $role->id }}" @if ($role->id === $userRole->role_id)
          selected
          @endif
          >{{ $role->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="block">
      <button type="submit" class="bg-blue-500 rounded-lg mt-2 px-4 py-1 text-white">
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
</x-app>