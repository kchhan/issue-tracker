<x-app title="Your Notifications" color="purple">
  <table>
    <thead>
      <tr>
        <th>Message</th>
        <th>Mark as read</th>
      </tr>
    </thead>

    <tbody>

      @forelse(auth()->user()->unreadNotifications as $notification)
      <tr>
        <td>{{ $notification->data['message'] }}</td>
        <td>
          <form method="post" action="/notifications/{{ $notification->id }}/">
            @method('PATCH')
            @csrf
            <input type="hidden" name="notification_uuid" value="{{ $notification->id }}">
            <button type="submit">Read</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td>You have no Notifications</td>
      </tr>

      @endempty


    </tbody>
  </table>




</x-app>