<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
  <div class="max-w-6xl mx-auto px-6 py-10">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <section class="mb-10">
      <h2 class="text-xl font-semibold mb-3">Recent Signups</h2>
      <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-left">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-3">ID</th>
              <th class="p-3">Name</th>
              <th class="p-3">Email</th>
              <th class="p-3">Created</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="border-t">
                <td class="p-3">{{ $user->id }}</td>
                <td class="p-3">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3">{{ $user->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>

    <section>
      <h2 class="text-xl font-semibold mb-3">Contact Messages</h2>
      <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-left">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-3">ID</th>
              <th class="p-3">Name</th>
              <th class="p-3">Email</th>
              <th class="p-3">Subject</th>
              <th class="p-3">Message</th>
              <th class="p-3">User</th>
              <th class="p-3">Received</th>
            </tr>
          </thead>
          <tbody>
            @foreach($contacts as $c)
              <tr class="border-t align-top">
                <td class="p-3">{{ $c->id }}</td>
                <td class="p-3">{{ $c->name }}</td>
                <td class="p-3">{{ $c->email }}</td>
                <td class="p-3">{{ $c->subject }}</td>
                <td class="p-3">{{ Str::limit($c->message, 120) }}</td>
                <td class="p-3">{{ $c->user_id ?? '-' }}</td>
                <td class="p-3">{{ $c->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </div>
</body>
</html>
