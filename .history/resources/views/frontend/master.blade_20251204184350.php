<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Unified Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Global Styles -->
  <link rel="stylesheet" href="./css/style.css">

  <!-- Optional: Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>CedarMind</title>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

  <!-- Responsive Header / Navbar (Tailwind) -->
  <header class="bg-white border-b sticky top-0 z-50 bg-opacity-95 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20 md:h-24">
        <div class="flex items-center">
          <a href="/" class="flex items-center">
            <img src="./image/logo.png" alt="CedarMind logo" class="h-16 md:h-20 lg:h-24 w-auto mr-3">
            <span class="sr-only">CedarMind</span>
          </a>
        </div>

        <!-- Desktop nav -->
        <nav class="hidden md:flex md:items-center md:space-x-6" aria-label="Primary">
          <a href="/" class="brand-link">Home</a>
          <a href="/courses" class="brand-link">Courses</a>
          <a href="#assignments" class="brand-link">Assignments</a>
          <a href="#discussions" class="brand-link">Discussions</a>
          <a href="#profile" class="brand-link">Profile</a>
          <a href="/contact" class="brand-link">Contact</a>
        </nav>

        <div class="hidden md:flex md:items-center md:space-x-3">
          <a href="/login" class="brand-outline px-3 py-1.5 rounded text-sm">Log in</a>
          <a href="/signup" class="brand-cta px-3 py-1.5 rounded text-sm">Get Started</a>
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

    <!-- Mobile menu, show/hide with JS -->
      <div id="mobile-menu" class="md:hidden hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="#dashboard" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
        <a href="#courses" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Courses</a>
        <a href="#assignments" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Assignments</a>
        <a href="#discussions" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Discussions</a>
        <a href="#profile" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Profile</a>
        <a href="/contact" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Contact</a>
      </div>
      <div class="px-4 pb-4 flex items-center space-x-2">
        <a href="/login" class="flex-1 text-center px-3 py-2 border rounded text-sm brand-link-mobile">Log in</a>
        <a href="/signup" class="flex-1 text-center px-3 py-2 brand-cta rounded text-sm">Get Started</a>
      </div>
    </div>
  </header>

  <main class="container-main">
    <!-- Hero: Creative intro -->
    <section class="hero relative overflow-hidden">
      <!-- Decorative background SVG using cedar palette -->
      <div class="absolute inset-0 -z-10 hero-bg" aria-hidden="true">
        <svg class="w-full h-full" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 600">
          <defs>
            <linearGradient id="g1" x1="0%" x2="100%" y1="0%" y2="100%">
              <stop offset="0%" stop-color="var(--cedar-dark)" stop-opacity="1"/>
              <stop offset="50%" stop-color="var(--cedar)" stop-opacity="0.95"/>
              <stop offset="100%" stop-color="var(--cedar-light)" stop-opacity="0.9"/>
            </linearGradient>

            <filter id="f1" x="-20%" y="-20%" width="140%" height="140%"><feGaussianBlur stdDeviation="60"/></filter>
          </defs>
          <rect width="1440" height="600" fill="url(#g1)" />
          <g filter="url(#f1)" opacity="0.18">
            <ellipse cx="300" cy="180" rx="220" ry="120" fill="#ffffff" />
            <ellipse cx="1100" cy="420" rx="260" ry="140" fill="#ffffff" />
          </g>
        </svg>
      </div>

      <div class="max-w-6xl mx-auto px-6 py-20 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
          <div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight brand-heading">CedarMind – Created by Students, for Students</h1>
            <p class="mt-4 text-lg text-slate-700">A learning platform built by students, where learners can access courses, track progress, and grow together — completely free of charge</p>

            <div class="mt-8 flex flex-wrap gap-3">
              <a href="/signup" class="brand-cta px-5 py-3 rounded-md shadow">Get Started</a>
              <a href="/courses" class="brand-outline px-5 py-3 rounded-md">Explore Courses</a>
              <a href="#about" class="px-5 py-3 rounded-md text-sm text-slate-700 bg-white/40 hover:bg-white/60">Watch Demo</a>
            </div>
          </div>

          <div class="hidden lg:block">
            <!-- Simple illustrative SVG (students + book) -->
            <svg viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg" class="w-full">
              <rect x="30" y="60" width="540" height="260" rx="20" fill="#fff" opacity="0.12"/>
              <g fill="none" stroke="var(--cedar-dark)" stroke-width="3">
                <path d="M120 220 C160 160, 240 160, 280 220" />
                <path d="M320 220 C360 160, 440 160, 480 220" />
              </g>
              <circle cx="200" cy="150" r="28" fill="var(--cedar-light)" opacity="0.95" />
              <circle cx="380" cy="150" r="28" fill="var(--cedar)" opacity="0.95" />
            </svg>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Key Features -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold brand-heading">Key Features</h2>
      <p class="mt-2 text-slate-700">Everything students need to learn,and .</p>

      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <article class="p-5 bg-white rounded-lg shadow-sm">
          <div class="text-3xl text-[var(--cedar)]"><i class="fa-solid fa-chalkboard-user"></i></div>
          <h3 class="mt-3 font-semibold">Curated Courses</h3>
          <p class="mt-1 text-sm text-slate-600">Access high-quality courses selected by students.</p>
        </article>

        <article class="p-5 bg-white rounded-lg shadow-sm">
          <div class="text-3xl text-[var(--cedar)]"><i class="fa-solid fa-laptop"></i></div>
          <h3 class="mt-3 font-semibold">Learn at Your Pace</h3>
          <p class="mt-1 text-sm text-slate-600">Flexible learning anywhere, anytime.</p>
        </article>
          <article class="p-5 bg-white rounded-lg shadow-sm">
          <div class="text-3xl text-[var(--cedar)]"><i class="fa-solid fa-certificate"></i></div>
          <h3 class="mt-3 font-semibold">Certificates</h3>
          <p class="mt-1 text-sm text-slate-600">Earn a certificate after the completion of each course.</p>
        </article>

        <article class="p-5 bg-white rounded-lg shadow-sm">
          <div class="text-3xl text-[var(--cedar)]"><i class="fa-solid  fa-credit-card-alt"></i></div>
          <h3 class="mt-3 font-semibold">Completely Free</h3>
          <p class="mt-1 text-sm text-slate-600">Access all courses without paying a single cent.</p>
        </article>

      
       </div>
     </section>

     <!-- About Us Section with Cedar Background -->
     <section class="about-us relative py-16 px-6 text-white overflow-hidden">
       <div class="absolute inset-0 -z-10 about-bg" aria-hidden="true">
         <svg class="w-full h-full" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 500">
           <defs>
             <linearGradient id="g2" x1="0%" x2="100%" y1="0%" y2="100%">
               <stop offset="0%" stop-color="var(--cedar-dark)" stop-opacity="1"/>
               <stop offset="100%" stop-color="var(--cedar)" stop-opacity="1"/>
             </linearGradient>
             <filter id="f2" x="-20%" y="-20%" width="140%" height="140%"><feGaussianBlur stdDeviation="50"/></filter>
           </defs>
           <rect width="1440" height="500" fill="url(#g2)" />
           <g filter="url(#f2)" opacity="0.15">
             <circle cx="200" cy="150" r="150" fill="#ffffff" />
             <circle cx="1200" cy="350" r="200" fill="#ffffff" />
           </g>
         </svg>
       </div>

       <div class="max-w-6xl mx-auto relative z-10">
         <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
           <div>
             <h2 class="text-3xl sm:text-4xl font-extrabold leading-tight">About CedarMind</h2>
             <p class="mt-4 text-lg opacity-90">CedarMind was created by students, for students. As learners ourselves, we experienced firsthand the challenges of finding quality courses, staying organized, and tracking progress. We wanted a platform that truly understands students’ needs — simple, accessible, and completely free.</p>
             
             <p class="mt-4 opacity-90">Our mission is to provide a space where learners can access courses, track their progress, and grow together in a supportive community. Every feature is designed from the learner’s perspective, making learning easier, more engaging, and more effective.</p>
           </div>

           <div class="hidden lg:block text-center bg-white/10 rounded-lg p-8">
             <img src="./image/logo.png" alt="CedarMind logo" class="h-70 w-auto mx-auto opacity-95 drop-shadow-2xl filter brightness-125">
           </div>
         </div>
       </div>
     </section>

     <!-- Starter content below the hero (kept minimal for now) -->
     <section class="py-12 px-6 max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold brand-heading">Featured courses</h2>
      <p class="mt-3 text-slate-700">Explore a selection of popular student-created courses.</p>
      <!-- Placeholder cards -->
      <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-4 bg-white rounded-lg shadow-sm">
          <h3 class="font-semibold">Intro to Web Development</h3>
          <p class="mt-2 text-sm text-slate-600">Built by students for students — learn HTML, CSS and JS.</p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-sm">
          <h3 class="font-semibold">Data Science Basics</h3>
          <p class="mt-2 text-sm text-slate-600">Hands-on projects covering data cleaning and visualization.</p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-sm">
          <h3 class="font-semibold">Collaborative Design</h3>
          <p class="mt-2 text-sm text-slate-600">Practical UX sessions created by peer instructors.</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-[var(--cedar-dark)] text-white py-16 px-6 mt-20">
    <div class="max-w-6xl mx-auto">
      <!-- Footer Top -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <!-- Brand -->
        <div class="lg:col-span-1">
          <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
            <img src="./image/logo.png" alt="CedarMind" class="h-8 w-auto">
            CedarMind
          </h3>
          <p class="text-sm opacity-80">Created by students, for students. Making quality education accessible to everyone.</p>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="font-semibold mb-4 text-lg">Quick Links</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#home" class="opacity-80 hover:opacity-100 transition">Home</a></li>
            <li><a href="#courses" class="opacity-80 hover:opacity-100 transition">Courses</a></li>
            <li><a href="#about" class="opacity-80 hover:opacity-100 transition">About Us</a></li>
            <li><a href="#contact" class="opacity-80 hover:opacity-100 transition">Contact</a></li>
          </ul>
        </div>


        <!-- Follow Us -->
        <div>
          <h4 class="font-semibold mb-4 text-lg">Follow Us</h4>
          <div class="space-y-2 text-sm">
            <a href="#facebook" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
              <i class="fa-brands fa-facebook-f text-sm"></i>
            </a>
            <a href="#twitter" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
              <i class="fa-brands fa-twitter text-sm"></i>
            </a>
            <a href="#linkedin" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
              <i class="fa-brands fa-linkedin-in text-sm"></i>
            </a>
            <a href="#instagram" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
              <i class="fa-brands fa-instagram text-sm"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Divider -->
      <hr class="border-white/20 mb-8">

      <!-- Footer Bottom -->
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm opacity-75">
        <p>&copy; 2025 CedarMind. All rights reserved.</p>
        <div class="flex gap-6">
          <a href="#privacy" class="hover:opacity-100 transition">Privacy Policy</a>
          <a href="#terms" class="hover:opacity-100 transition">Terms of Service</a>
          <a href="#cookies" class="hover:opacity-100 transition">Cookie Settings</a>
        </div>
      </div>
    </div>
  </footer>

 <script src="js\main.js"></script>


</body>
</html>


