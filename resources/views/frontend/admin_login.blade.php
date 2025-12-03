<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Unified Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Global Styles -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Optional: Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin Log In - CedarMind</title>
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

  <header class="bg-white border-b sticky top-0 z-50 bg-opacity-95 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20 md:h-24">
        <a href="/" class="flex items-center">
          <img src="{{ asset('image/logo.png') }}" alt="CedarMind logo" class="h-16 md:h-20 lg:h-24 w-auto mr-3">
          <span class="sr-only">CedarMind</span>
        </a>
      </div>
    </div>
  </header>

  <main class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold brand-heading">Admin Login</h1>
        <p class="text-slate-600 mt-2">Access the admin dashboard</p>
      </div>

      @if ($errors->any())
        <div class="mb-4 bg-red-50 text-red-700 p-3 rounded-lg text-sm">
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-3 rounded-lg text-sm">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ url('/login') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Email Input -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
          <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cedar)] focus:border-transparent" placeholder="your@email.com" value="{{ old('email') }}">
        </div>

        <!-- Password Input -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cedar)] focus:border-transparent" placeholder="••••••••">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full brand-cta px-4 py-2 rounded-lg font-semibold transition">Log In</button>
      </form>

      <!-- Info -->
      <p class="text-center text-gray-600 mt-6 text-sm">
        Test credentials: test1@example.com / secret123
      </p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-[var(--cedar-dark)] text-white py-8 px-6 mt-20">
    <div class="max-w-6xl mx-auto text-center text-sm opacity-75">
      <p>&copy; 2025 CedarMind. All rights reserved.</p>
    </div>
  </footer>

</body>

</html>
