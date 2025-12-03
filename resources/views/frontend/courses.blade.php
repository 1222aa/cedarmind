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
  <title>Courses - CedarMind</title>
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
          <a href="/courses" class="brand-link">Courses</a>
          <a href="#" class="brand-link">Dashboard</a>
        </nav>

        <div class="hidden md:flex md:items-center md:space-x-3">
          <span id="userName" class="text-gray-700 font-medium"></span>
          <button id="logoutBtn" class="brand-outline px-3 py-1.5 rounded text-sm">Log Out</button>
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
        <a href="/courses" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Courses</a>
        <a href="#" class="brand-link-mobile block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
      </div>
      <div class="px-4 pb-4 flex items-center space-x-2">
        <span id="userNameMobile" class="text-gray-700 font-medium flex-1"></span>
        <button id="logoutBtnMobile" class="flex-1 text-center px-3 py-2 border rounded text-sm brand-link-mobile">Log Out</button>
      </div>
    </div>
  </header>

  <main class="container-main py-12 px-6 max-w-6xl mx-auto">
    <!-- Welcome Section -->
    <div class="mb-12">
      <h1 class="text-4xl font-bold brand-heading">My Courses</h1>
      <p class="text-slate-600 mt-2">Welcome to your learning journey. Choose a course and start learning.</p>
    </div>

    <!-- Courses Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="coursesContainer">
      <!-- Courses will be loaded here dynamically -->
      <div class="text-center text-gray-500 py-12">Loading courses...</div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-[var(--cedar-dark)] text-white py-8 px-6 mt-20">
    <div class="max-w-6xl mx-auto text-center text-sm opacity-75">
      <p>&copy; 2025 CedarMind. All rights reserved.</p>
    </div>
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    // Check if user is logged in
    async function checkAuth() {
      const token = localStorage.getItem('cedarmind_token');
      const user = localStorage.getItem('cedarmind_user');
      
      if (!token || !user) {
        window.location.href = '/login';
        return;
      }
      
      try {
        const userData = JSON.parse(user);
        document.getElementById('userName').textContent = `Welcome, ${userData.name}!`;
        document.getElementById('userNameMobile').textContent = `Welcome, ${userData.name}!`;
      } catch (e) {
        console.error('Error parsing user data');
      }
    }
    
    // Fetch and display courses
    async function loadCourses() {
      const token = localStorage.getItem('cedarmind_token');
      const coursesContainer = document.getElementById('coursesContainer');
      
      try {
        const response = await fetch('/api/courses', {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });
        
        if (response.status === 401) {
          // Token expired or invalid
          localStorage.removeItem('cedarmind_token');
          localStorage.removeItem('cedarmind_user');
          window.location.href = '/login';
          return;
        }
        
        const data = await response.json();
        
        if (response.ok && data.courses) {
          displayCourses(data.courses);
        } else {
          coursesContainer.innerHTML = '<div class="text-center text-gray-500 py-12">No courses available</div>';
        }
      } catch (error) {
        console.error('Error loading courses:', error);
        // Fallback: show sample courses
        displaySampleCourses();
      }
    }
    
    function displayCourses(courses) {
      const coursesContainer = document.getElementById('coursesContainer');
      coursesContainer.innerHTML = '';
      
      courses.forEach(course => {
        const courseCard = document.createElement('div');
        courseCard.className = 'bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition cursor-pointer';
        courseCard.innerHTML = `
          <div class="h-40 bg-gradient-to-br from-[var(--cedar)] to-[var(--cedar-light)]"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold brand-heading">${course.title}</h3>
            <p class="text-slate-600 text-sm mt-2">${course.description || 'No description'}</p>
            <div class="mt-4 flex items-center justify-between">
              <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full">${course.level || 'Beginner'}</span>
              <span class="text-xs text-gray-600">${course.lesson_count || 0} lessons</span>
            </div>
          </div>
        `;
        courseCard.addEventListener('click', () => {
          window.location.href = `/courses/${course.id}`;
        });
        coursesContainer.appendChild(courseCard);
      });
    }
    
    function displaySampleCourses() {
      const coursesContainer = document.getElementById('coursesContainer');
      const sampleCourses = [
        { id: 1, title: 'evelopment', description: 'Learn HTML,avaScript from scratch.', level: 'Beginner' },
        { id: 2, title: 'Data Science Basics', description: 'Master data analysis with Python and practical projects.', level: 'Intermediate' },
        { id: 3, title: 'UX/UI Design Principles', description: 'Create stunning user experiences with design thinking.', level: 'Intermediate' },
        { id: 4, title: 'Advanced JavaScript', description: 'Deep dive into async programming, closures, and more.', level: 'Advanced' },
        { id: 5, title: 'Collaborative Design', description: 'Work in teams and practice real-world design workflows.', level: 'Intermediate' },
        { id: 6, title: 'Mobile App Development', description: 'Build iOS and Android apps with modern frameworks.', level: 'Advanced' }
      ];
      
      displayCourses(sampleCourses);
    }
    
    // Logout handler
    function setupLogout() {
      const logoutBtn = document.getElementById('logoutBtn');
      const logoutBtnMobile = document.getElementById('logoutBtnMobile');
      
      logoutBtn.addEventListener('click', logout);
      logoutBtnMobile.addEventListener('click', logout);
    }
    
    async function logout() {
      const token = localStorage.getItem('cedarmind_token');
      
      try {
        // Call Laravel logout endpoint
        await fetch('/api/logout', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });
      } catch (error) {
        console.error('Logout error:', error);
      }
      
      // Clear local storage and redirect
      localStorage.removeItem('cedarmind_token');
      localStorage.removeItem('cedarmind_user');
      window.location.href = '/';
    }
    
    // Initialize
    checkAuth();
    loadCourses();
    setupLogout();
  </script>

</body>

</html>
