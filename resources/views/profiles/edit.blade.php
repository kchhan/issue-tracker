<x-app title="Edit Profile" color="yellow">
  <div class="container mx-auto inline-block">
    <form method="POST" action="/profiles/{{ $user->username }}" enctype="multipart/form-data">
      @csrf
      @method("PATCH")

      <div class="inline">
        <label for="first_name" class="block font-bold mb-1 mx-4  text-gray-700">First Name</label>
        <input type="text" name="first_name"
          class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
          value="{{ old('first_name', $user->first_name) }}" required />
      </div>

      <div class="inline">
        <label for="last_name" class="block font-bold mb-1 mx-4 text-gray-700">Last Name</label>
        <input type="text" name="last_name"
          class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
          value="{{ old('last_name', $user->last_name) }}" required />
      </div>

      <div class="inline">
        <label for="username" class="block font-bold mb-1 mx-4 text-gray-700">Username</label>
        <input type="text" name="username"
          class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
          value="{{ old('username', $user->username) }}" required />
      </div>

      <div class="inline">
        <label for="avatar" class="block font-bold mb-1 mx-4 text-gray-700">Avatar</label>
        <input type="file" name="avatar"
          class="shadow appearance-none border rounded mx-4 p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-1/2"
          required />
        <img src="{{ $user->avatar }}" alt="Current Avatar" width="40">
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