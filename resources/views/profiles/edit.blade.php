<x-app title="Edit Profile" color="yellow">
  <form method="POST" action="/profiles/{{ $user->username }}" enctype="multipart/form-data"
    class="m-2 p-2 mx-auto max-w-3xl bg-gray-200">
    @csrf
    @method("PATCH")

    <div class="inline">
      <label for="first_name" class="block font-bold mb-1  text-gray-700">First Name</label>
      <input type="text" name="first_name"
        class="shadow appearance-none border rounded p-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
        value="{{ old('first_name', $user->first_name) }}" required />
    </div>

    <div class="inline">
      <label for="last_name" class="block font-bold mb-1 text-gray-700">Last Name</label>
      <input type="text" name="last_name"
        class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
        value="{{ old('last_name', $user->last_name) }}" required />
    </div>

    <div class="inline">
      <label for="username" class="block font-bold mb-1 text-gray-700">Username</label>
      <input type="text" name="username"
        class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
        value="{{ old('username', $user->username) }}" required />
    </div>

    <div class="inline">
      <label for="email" class="block font-bold mb-1 text-gray-700">Email</label>
      <input type="email" name="email"
        class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
        value="{{ old('email', $user->email) }}" required />
    </div>

    <div class="inline">
      <label for="avatar" class="block font-bold mb-1 text-gray-700">Avatar</label>
      <div class="flex">
        <input type="file" name="avatar"
          class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" />
        <img src="{{ $user->avatar }}" alt="Current Avatar" width="40">
      </div>
    </div>

    <div class="inline">
      <label for="password" class="block font-bold mb-1 text-gray-700">Password</label>
      <input type="password" name="password"
        class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" />
    </div>

    <div class="inline">
      <label for="password_confirmation" class="block font-bold mb-1 text-gray-700">Confirm Password</label>
      <input type="password" name="password_confirmation"
        class="shadow appearance-none border rounded p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" />
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