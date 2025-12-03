<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Course - CedarMind</title>
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

  <!-- Header -->
  <header class="bg-white border-b sticky top-0 z-50 bg-opacity-95 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20 md:h-24">
        <div class="flex items-center">
          <a href="/" class="flex items-center">
            <img src="{{ asset('image/logo.png') }}" alt="CedarMind logo" class="h-16 md:h-20 lg:h-24 w-auto mr-3">
          </a>
        </div>

        <nav class="hidden md:flex md:items-center md:space-x-6">
          <a href="/" class="brand-link">Home</a>
          <a href="/courses" class="brand-link">Courses</a>
        </nav>

        <div class="hidden md:flex md:items-center md:space-x-3">
          <span id="userName" class="text-gray-700 font-medium"></span>
          <button id="logoutBtn" class="brand-outline px-3 py-1.5 rounded text-sm">Log Out</button>
        </div>

        <div class="md:hidden">
          <button id="nav-toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="/" class="brand-link-mobile block px-3 py-2">Home</a>
        <a href="/courses" class="brand-link-mobile block px-3 py-2">Courses</a>
      </div>
    </div>
  </header>

  <main class="container-main py-8 px-6 max-w-6xl mx-auto">
    <!-- Back Button -->
    <a href="/courses" class="inline-flex items-center text-[var(--cedar)] hover:text-[var(--cedar-dark)] mb-6">
      <i class="fas fa-arrow-left mr-2"></i> Back to Courses
    </a>

    <!-- Course Header -->
    <div class="bg-gradient-to-br from-[var(--cedar)] to-[var(--cedar-light)] rounded-lg p-8 text-white mb-8">
      <h1 id="courseTitle" class="text-4xl font-bold mb-4">Loading...</h1>
      <div id="courseMetadata" class="flex flex-wrap gap-4 text-sm">
        <div class="flex items-center">
          <i class="fas fa-user mr-2"></i>
          <span id="instructorName">-</span>
        </div>
        <div class="flex items-center">
          <i class="fas fa-clock mr-2"></i>
          <span id="courseDuration">-</span>
        </div>
        <div class="flex items-center">
          <i class="fas fa-layer-group mr-2"></i>
          <span id="lessonCount">-</span>
        </div>
      </div>
    </div>

    <!-- Tab Navigation -->
    <div class="flex border-b border-gray-200 mb-8 overflow-x-auto">
      <button class="tab-btn active py-4 px-6 font-semibold border-b-2 border-[var(--cedar)] text-[var(--cedar)]" data-tab="overview">
        <i class="fas fa-book mr-2"></i> Overview
      </button>
      <button class="tab-btn py-4 px-6 font-semibold border-b-2 border-transparent text-gray-600 hover:text-gray-900" data-tab="lessons">
        <i class="fas fa-list mr-2"></i> Lessons
      </button>
      <button class="tab-btn py-4 px-6 font-semibold border-b-2 border-transparent text-gray-600 hover:text-gray-900" data-tab="progress">
        <i class="fas fa-chart-bar mr-2"></i> Progress
      </button>
    </div>

    <!-- Tab Content -->

    <!-- Overview Tab -->
    <div id="overview-content" class="tab-content active space-y-8">
      <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
          <h2 class="text-2xl font-bold brand-heading mb-4">About This Course</h2>
          <p id="courseLongDescription" class="text-gray-700 leading-relaxed mb-6">Loading description...</p>

          <h3 class="text-xl font-bold brand-heading mb-4">Learning Outcomes</h3>
          <ul id="learningOutcomes" class="space-y-2">
            <li class="text-gray-700"><i class="fas fa-check text-[var(--cedar)] mr-2"></i> Loading outcomes...</li>
          </ul>
        </div>

        <div class="bg-white rounded-lg shadow p-6 h-fit sticky top-24">
          <h3 class="text-lg font-bold brand-heading mb-4">Course Details</h3>
          <dl class="space-y-4">
            <div>
              <dt class="text-gray-600 text-sm">Level</dt>
              <dd id="courseLevel" class="font-semibold">-</dd>
            </div>
            <div>
              <dt class="text-gray-600 text-sm">Duration</dt>
              <dd id="courseDurationDetail" class="font-semibold">-</dd>
            </div>
            <div>
              <dt class="text-gray-600 text-sm">Lessons</dt>
              <dd id="lessonCountDetail" class="font-semibold">-</dd>
            </div>
            <div>
              <dt class="text-gray-600 text-sm">Instructor</dt>
              <dd id="instructorDetail" class="font-semibold">-</dd>
            </div>
          </dl>
        </div>
      </div>
    </div>

    <!-- Lessons Tab -->
    <div id="lessons-content" class="tab-content hidden space-y-6">
      <div id="lessonsList" class="space-y-4">
        <p class="text-gray-500">Loading lessons...</p>
      </div>
    </div>

    <!-- Progress Tab -->
    <div id="progress-content" class="tab-content hidden">
      <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold brand-heading mb-6">Your Progress</h3>
        <div id="progressStats" class="grid md:grid-cols-4 gap-4 mb-8">
          <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg p-4">
            <p class="text-gray-600 text-sm mb-1">Lessons Completed</p>
            <p id="lessonsCompleted" class="text-3xl font-bold text-blue-600">0</p>
          </div>
          <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-lg p-4">
            <p class="text-gray-600 text-sm mb-1">Quizzes Passed</p>
            <p id="quizzesPassed" class="text-3xl font-bold text-green-600">0</p>
          </div>
          <div class="bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-lg p-4">
            <p class="text-gray-600 text-sm mb-1">Average Score</p>
            <p id="averageScore" class="text-3xl font-bold text-yellow-600">--</p>
          </div>
          <div class="bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg p-4">
            <p class="text-gray-600 text-sm mb-1">Total Time</p>
            <p id="totalTime" class="text-3xl font-bold text-purple-600">--</p>
          </div>
        </div>

        <h4 class="text-lg font-semibold mb-4">Quiz Results</h4>
        <div id="quizResults" class="space-y-3">
          <p class="text-gray-500">No quiz attempts yet</p>
        </div>
      </div>
    </div>

  </main>

  <!-- Modal for Lesson Content -->
  <div id="lessonModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
      <div class="sticky top-0 bg-white border-b p-4 flex items-center justify-between">
        <h2 id="modalTitle" class="text-2xl font-bold">Lesson Content</h2>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times text-2xl"></i>
        </button>
      </div>

      <div id="modalContent" class="p-6">
        <!-- Content will be loaded here -->
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-[var(--cedar-dark)] text-white py-8 px-6 mt-20">
    <div class="max-w-6xl mx-auto text-center text-sm opacity-75">
      <p>&copy; 2025 CedarMind. All rights reserved.</p>
    </div>
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    const courseId = {{ $courseId }};
    let courseData = null;

    // Check auth
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
      } catch (e) {
        console.error('Error parsing user data');
      }
    }

    // Load course details
    async function loadCourseDetails() {
      const token = localStorage.getItem('cedarmind_token');
      
      try {
        const response = await fetch(`/api/courses/${courseId}`, {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });
        
        if (response.status === 401) {
          localStorage.removeItem('cedarmind_token');
          localStorage.removeItem('cedarmind_user');
          window.location.href = '/login';
          return;
        }

        if (!response.ok) {
          throw new Error('Failed to load course');
        }

        const data = await response.json();
        courseData = data.course;
        displayCourseDetails();
        displayLessons();
      } catch (error) {
        console.error('Error loading course:', error);
        document.getElementById('courseTitle').textContent = 'Error loading course';
      }
    }

    function displayCourseDetails() {
      document.getElementById('courseTitle').textContent = courseData.title;
      document.getElementById('courseLongDescription').textContent = courseData.long_description || courseData.description;
      document.getElementById('instructorName').textContent = courseData.instructor || 'TBD';
      document.getElementById('courseDuration').textContent = courseData.duration_hours ? `${courseData.duration_hours} hours` : 'TBD';
      document.getElementById('lessonCount').textContent = `${courseData.lessons.length} lessons`;
      
      document.getElementById('courseLevel').textContent = courseData.level;
      document.getElementById('courseDurationDetail').textContent = courseData.duration_hours ? `${courseData.duration_hours} hours` : 'TBD';
      document.getElementById('lessonCountDetail').textContent = courseData.lessons.length;
      document.getElementById('instructorDetail').textContent = courseData.instructor || 'TBD';

      // Learning outcomes
      const outcomesContainer = document.getElementById('learningOutcomes');
      outcomesContainer.innerHTML = '';
      if (courseData.learning_outcomes && Array.isArray(courseData.learning_outcomes)) {
        courseData.learning_outcomes.forEach(outcome => {
          const li = document.createElement('li');
          li.className = 'text-gray-700';
          li.innerHTML = `<i class="fas fa-check text-[var(--cedar)] mr-2"></i> ${outcome}`;
          outcomesContainer.appendChild(li);
        });
      }
    }

    function displayLessons() {
      const lessonsList = document.getElementById('lessonsList');
      lessonsList.innerHTML = '';

      courseData.lessons.forEach((lesson, index) => {
        const lessonDiv = document.createElement('div');
        lessonDiv.className = 'bg-white rounded-lg shadow p-6';
        
        let contentHTML = `
          <div class="flex items-start justify-between mb-4">
            <div>
              <h3 class="text-lg font-bold brand-heading">Lesson ${index + 1}: ${lesson.title}</h3>
              <p class="text-gray-600 text-sm mt-1">${lesson.description || 'No description'}</p>
            </div>
            <span class="bg-[var(--cedar)] text-white text-xs px-3 py-1 rounded-full">
              ${lesson.contents.length} items
            </span>
          </div>

          <div class="space-y-2">
        `;

        lesson.contents.forEach(content => {
          const contentTypeIcon = {
            'video': 'fas fa-play-circle',
            'presentation': 'fas fa-file-powerpoint',
            'written': 'fas fa-file-alt',
            'quiz': 'fas fa-question-circle'
          }[content.type] || 'fas fa-file';

          const contentTypeLabel = {
            'video': 'Video',
            'presentation': 'Presentation',
            'written': 'Written Content',
            'quiz': 'Quiz'
          }[content.type] || 'File';

          contentHTML += `
            <button class="content-btn w-full text-left flex items-center justify-between p-3 rounded border border-gray-200 hover:border-[var(--cedar)] hover:bg-blue-50 transition" data-content-id="${content.id}" data-content-type="${content.type}" data-lesson-id="${lesson.id}">
              <div class="flex items-center">
                <i class="${contentTypeIcon} text-[var(--cedar)] mr-3"></i>
                <div>
                  <p class="font-semibold text-gray-900">${content.title}</p>
                  <p class="text-xs text-gray-500">${contentTypeLabel}</p>
                </div>
              </div>
              <i class="fas fa-arrow-right text-gray-400"></i>
            </button>
          `;
        });

        contentHTML += '</div>';
        lessonDiv.innerHTML = contentHTML;
        lessonsList.appendChild(lessonDiv);
      });

      // Add content button listeners
      document.querySelectorAll('.content-btn').forEach(btn => {
        btn.addEventListener('click', handleContentClick);
      });
    }

    async function handleContentClick(e) {
      const contentId = e.currentTarget.dataset.contentId;
      const contentType = e.currentTarget.dataset.contentType;
      const lessonId = e.currentTarget.dataset.lessonId;

      const lesson = courseData.lessons.find(l => l.id == lessonId);
      const content = lesson.contents.find(c => c.id == contentId);

      document.getElementById('modalTitle').textContent = content.title;
      
      const modalContent = document.getElementById('modalContent');
      
      switch(content.type) {
        case 'video':
          modalContent.innerHTML = `
            <div class="aspect-video bg-black rounded-lg mb-4">
              <iframe width="100%" height="100%" src="${content.url}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <p class="text-gray-700">${content.content || 'Video content'}</p>
          `;
          break;

        case 'presentation':
          modalContent.innerHTML = `
            <div class="bg-gray-100 rounded-lg p-6 text-center mb-4">
              <i class="fas fa-file-powerpoint text-4xl text-[var(--cedar)] mb-4"></i>
              <p class="font-semibold">${content.title}</p>
              <a href="${content.file_path}" target="_blank" class="inline-block mt-4 bg-[var(--cedar)] text-white px-4 py-2 rounded font-semibold hover:bg-[var(--cedar-dark)]">
                Download Presentation <i class="fas fa-download ml-2"></i>
              </a>
            </div>
          `;
          break;
case 'written':
  modalContent.innerHTML = `
    <div class="prose max-w-none">
      <a href="/storage/${content.content}" target="_blank" class="text-[var(--cedar)] font-semibold hover:underline">
        View PDF
      </a>
    </div>
  `;
  break;





        case 'quiz':
          displayQuiz(content, lesson.id);
          break;
      }

      document.getElementById('lessonModal').classList.remove('hidden');
    }

    function displayQuiz(quiz, lessonId) {
      const modalContent = document.getElementById('modalContent');
      let quizHTML = '<form id="quizForm" class="space-y-6">';

      quiz.quiz_questions.forEach((question, index) => {
        quizHTML += `
          <div class="border rounded-lg p-6">
            <p class="font-semibold text-lg mb-4">Question ${index + 1}: ${question.question}</p>
            <div class="space-y-3">
        `;

        question.options.forEach((option, optionIndex) => {
          quizHTML += `
            <label class="flex items-center p-3 border rounded cursor-pointer hover:bg-blue-50 transition">
              <input type="radio" name="question_${question.id}" value="${option}" class="mr-3">
              <span>${option}</span>
            </label>
          `;
        });

        quizHTML += '</div></div>';
      });

      quizHTML += `
        <button type="submit" class="w-full bg-[var(--cedar)] text-white py-3 rounded-lg font-semibold hover:bg-[var(--cedar-dark)] transition">
          Submit Quiz
        </button>
      </form>
      `;

      modalContent.innerHTML = quizHTML;

      document.getElementById('quizForm').addEventListener('submit', (e) => {
        e.preventDefault();
        submitQuiz(quiz.id);
      });
    }

    async function submitQuiz(contentId) {
      const token = localStorage.getItem('cedarmind_token');
      const formData = new FormData(document.getElementById('quizForm'));
      
      const answers = {};
      courseData.lessons.forEach(lesson => {
        lesson.contents.forEach(content => {
          if (content.id == contentId) {
            content.quiz_questions.forEach(q => {
              answers[q.id] = formData.get(`question_${q.id}`);
            });
          }
        });
      });

      try {
        const response = await fetch('/api/quiz/submit', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
          },
          body: JSON.stringify({
            lesson_content_id: contentId,
            answers: answers
          })
        });

        if (response.ok) {
          const data = await response.json();
          showQuizResults(data, contentId);
        } else {
          alert('Error submitting quiz');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Error submitting quiz');
      }
    }

    function showQuizResults(data, contentId) {
      const modalContent = document.getElementById('modalContent');
      const percentage = data.score;
      const passed = percentage >= 70;

      let resultsHTML = `
        <div class="text-center py-8">
          <div class="inline-block mb-6">
            <div class="w-24 h-24 rounded-full flex items-center justify-center ${passed ? 'bg-green-100' : 'bg-red-100'} mb-4">
              <i class="fas fa-${passed ? 'check' : 'times'} text-4xl ${passed ? 'text-green-600' : 'text-red-600'}"></i>
            </div>
          </div>
          <h3 class="text-2xl font-bold mb-2">${passed ? 'Congratulations!' : 'Try Again'}</h3>
          <p class="text-gray-600 mb-6">${passed ? 'You passed the quiz!' : 'You need 70% to pass'}</p>
          
          <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-6 mb-6">
            <div class="text-3xl font-bold text-[var(--cedar)]">${data.score}%</div>
            <p class="text-gray-700">${data.correct_answers} of ${data.total_questions} correct</p>
          </div>

          <div class="space-y-2 text-left mb-6 max-h-60 overflow-y-auto">
      `;

      Object.entries(data.answers).forEach((key, index) => {
        const answer = data.answers[key];
        const isCorrect = answer.is_correct;
        resultsHTML += `
          <div class="border rounded-lg p-3 ${isCorrect ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'}">
            <p class="text-sm font-semibold">${isCorrect ? '✓' : '✗'} Question ${parseInt(key) + 1}</p>
            ${!isCorrect ? `<p class="text-xs text-gray-600 mt-1">Correct: ${answer.correct_answer}</p>` : ''}
            ${answer.explanation ? `<p class="text-xs text-gray-700 mt-2">${answer.explanation}</p>` : ''}
          </div>
        `;
      });

      resultsHTML += `
          </div>
          <button onclick="location.reload()" class="bg-[var(--cedar)] text-white px-6 py-2 rounded font-semibold hover:bg-[var(--cedar-dark)]">
            Close
          </button>
        </div>
      `;

      modalContent.innerHTML = resultsHTML;
    }

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const tabName = btn.dataset.tab;

        document.querySelectorAll('.tab-btn').forEach(b => {
          b.classList.remove('active', 'border-[var(--cedar)]', 'text-[var(--cedar)]');
          b.classList.add('border-transparent', 'text-gray-600');
        });
        btn.classList.add('active', 'border-[var(--cedar)]', 'text-[var(--cedar)]');
        btn.classList.remove('border-transparent', 'text-gray-600');

        document.querySelectorAll('.tab-content').forEach(content => {
          content.classList.add('hidden');
        });
        document.getElementById(`${tabName}-content`).classList.remove('hidden');
      });
    });

    // Modal handling
    document.getElementById('closeModal').addEventListener('click', () => {
      document.getElementById('lessonModal').classList.add('hidden');
    });

    document.getElementById('lessonModal').addEventListener('click', (e) => {
      if (e.target.id === 'lessonModal') {
        document.getElementById('lessonModal').classList.add('hidden');
      }
    });

    // Logout
    document.getElementById('logoutBtn').addEventListener('click', async () => {
      const token = localStorage.getItem('cedarmind_token');
      try {
        await fetch('/api/logout', {
          method: 'POST',
          headers: { 'Authorization': `Bearer ${token}` }
        });
      } catch (e) {}
      localStorage.removeItem('cedarmind_token');
      localStorage.removeItem('cedarmind_user');
      window.location.href = '/';
    });

    // Initialize
    checkAuth();
    loadCourseDetails();

    // Mobile menu
    document.getElementById('nav-toggle').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
  </script>

</body>

</html>
