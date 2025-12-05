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
  <title>Log In - CedarMind</title>
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

  <!-- Responsive Header / Navbar (Tailwind) -->
  <header class="bg-white border-b sticky top-0 z-50 bg-opacity-95 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20 md:h-24">
        <div class="flex items-center">
          <a href="/" class="flex items-center">
            <img src="{{ asset('image/logo.png') }}" alt="CedarMind logo" class="h-16 md:h-20 lg:h-24 w-auto mr-3">
            <span class="sr-only">CedarMind</span>
          </a>
        </div>

        <!-- Desktop nav -->
        <nav class="hidden md:flex md:items-center md:space-x-6" aria-label="Primary">
          <a href="/" class="brand-link">Home</a>
          <a href="/#courses" class="brand-link">Courses</a>
          <a href="/#about" class="brand-link">About</a>
        </nav>

        <div class="hidden md:flex md:items-center md:space-x-3">
          <a href="#" class="brand-outline px-3 py-1.5 rounded text-sm">Log in</a>
          <a href="/signup" class="brand-cta px-3 py-1.5 rounded text-sm">Sign Up</a>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button id="nav-toggle" aria-controls="mobile-menu" aria-expanded="false" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="/" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Home</a>
        <a href="/#courses" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Courses</a>
        <a href="/#about" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">About</a>
      </div>
      <div class="px-4 pb-4 flex items-center space-x-2">
        <a href="#" class="flex-1 text-center px-3 py-2 border rounded text-sm brand-link-mobile">Log in</a>
        <a href="/signup" class="flex-1 text-center px-3 py-2 brand-cta rounded text-sm">Sign Up</a>
      </div>
    </div>
  </header>

  <main class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold brand-heading">Log In</h1>
        <p class="text-slate-600 mt-2">Welcome back to CedarMind</p>
      </div>

      <form id="login-form" class="space-y-4">
        <!-- Email Input -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
          <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cedar)] focus:border-transparent" placeholder="your@email.com">
        </div>

        <!-- Password Input -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cedar)] focus:border-transparent" placeholder="••••••••">
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center">
            <input type="checkbox" class="rounded border-gray-300" name="remember">
            <span class="ml-2 text-gray-600">Remember me</span>
          </label>
          <a href="#" class="brand-link">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full brand-cta px-4 py-2 rounded-lg font-semibold transition">Log In</button>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-50 text-red-700 p-3 rounded-lg text-sm"></div>

        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-50 text-green-700 p-3 rounded-lg text-sm"></div>
      </form>

      <!-- Sign Up Link -->
      <p class="text-center text-gray-600 mt-6">
        Don't have an account? <a href="/signup" class="brand-link font-semibold">Sign up here</a>
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

  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    document.getElementById('login-form').addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      const errorDiv = document.getElementById('errorMessage');
      const successDiv = document.getElementById('successMessage');
      
      errorDiv.classList.add('hidden');
      successDiv.classList.add('hidden');

      try {
        const res = await fetch('/api/login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email, password }),
        });

        const data = await res.json();

        if (res.ok && data.token) {
          localStorage.setItem('cedarmind_token', data.token);
          localStorage.setItem('cedarmind_user', JSON.stringify(data.user));
          
          successDiv.textContent = 'Login successful! Redirecting...';
          successDiv.classList.remove('hidden');
          
          setTimeout(() => {
            window.location.href = '/courses';
          }, 1500);
        } else {
          errorDiv.textContent = data.message || 'Invalid email or password. Please try again.';
          errorDiv.classList.remove('hidden');
        }
      } catch (err) {
        errorDiv.textContent = 'Network error — try again later';
        errorDiv.classList.remove('hidden');
      }
    });
  </script>

</body>

</html>
