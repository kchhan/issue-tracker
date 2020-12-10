<x-app title="Your Notifications" color="purple">
  <table class="border-collapse m-5 mx-auto md:w-4/5 sm:w-full">
    <thead class="text-left font-bold">
      <tr>
        <th class="p-2 border border-solid bg-purple-300">Message</th>
        <th class="p-2 border border-solid bg-purple-300">Mark as read</th>
      </tr>
    </thead>

    <tbody>
      @forelse(auth()->user()->unreadNotifications as $notification)
      <tr>
        <td class="p-2 border border-solid even:bg-gray-200 w-4/5">
          {{ $notification->data['message'] }}
        </td>
        <td class="p-2 border border-solid even:bg-gray-200 w-1/5">
          <form method="post" action="/notifications/{{ $notification->id }}/">
            @method('PATCH')
            @csrf
            <input type="hidden" name="notification_uuid" value="{{ $notification->id }}">
            <button type="submit" class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
              Read
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td class="p-2 border border-solid even:bg-gray-200 w-4/5">You have no Notifications</td>
        <td class="p-2 border border-solid even:bg-gray-200 w-1/5"></td>
      </tr>
      @endempty
    </tbody>
  </table>
</x-app>