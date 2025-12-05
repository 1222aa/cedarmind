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
  <footer class="bg-[var(--cedar-dark)] text-white py-12 px-6 mt-20">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Brand -->
        <div>
          <div class="flex items-center gap-2 mb-3">
            <img src="./image/logo.png" alt="CedarMind" class="h-8 w-auto">
            <span class="font-bold text-lg">CedarMind</span>
          </div>
          <p class="text-sm text-white/70">Quality education accessible to everyone</p>
        </div>

        <!-- Links -->
        <div>
          <h4 class="font-semibold mb-3 text-sm">NAVIGATION</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="/" class="text-white/70 hover:text-white transition">Home</a></li>
            <li><a href="/courses" class="text-white/70 hover:text-white transition">Courses</a></li>
            <li><a href="/contact" class="text-white/70 hover:text-white transition">Contact</a></li>
          </ul>
        </div>

        <!-- Social -->
        <div>
          <h4 class="font-semibold mb-3 text-sm">FOLLOW US</h4>
          <div class="flex gap-3">
            <a href="#facebook" class="text-white/70 hover:text-white transition text-lg"><i class="fab fa-facebook-f"></i></a>
            <a href="#twitter" class="text-white/70 hover:text-white transition text-lg"><i class="fab fa-twitter"></i></a>
            <a href="#linkedin" class="text-white/70 hover:text-white transition text-lg"><i class="fab fa-linkedin-in"></i></a>
            <a href="#instagram" class="text-white/70 hover:text-white transition text-lg"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>

      <!-- Divider -->
      <hr class="border-white/20 mb-6">

      <!-- Bottom -->
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-white/60">
        <p>&copy; 2025 CedarMind. All rights reserved.</p>
        <div class="flex gap-6 text-xs">
          <a href="#privacy" class="hover:text-white transition">Privacy</a>
          <a href="#terms" class="hover:text-white transition">Terms</a>
          <a href="#cookies" class="hover:text-white transition">Cookies</a>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>
