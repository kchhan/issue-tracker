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
        <td><a href="#" data-id="{{ $notification->id }}">Read</a></td>
      </tr>
      @empty
      <tr>
        <td>You have no Notifications</td>
      </tr>

      @endempty


    </tbody>
  </table>




</x-app>