<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Contact - CedarMind</title>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

  <header class="bg-white border-b sticky top-0 z-50 bg-opacity-95 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20 md:h-24">
        <div class="flex items-center">
          <a href="/" class="flex items-center">
            <img src="{{ asset('image/logo.png') }}" alt="CedarMind logo" class="h-16 md:h-20 lg:h-24 w-auto mr-3">
            <span class="sr-only">CedarMind</span>
          </a>
        </div>

        <nav class="hidden md:flex md:items-center md:space-x-6" aria-label="Primary">
          <a href="/" class="brand-link">Home</a>
          <a href="/courses" class="brand-link">Courses</a>
          <a href="/contact" class="brand-link">Contact</a>
        </nav>

        <div class="hidden md:flex md:items-center md:space-x-3">
          <a href="/login" class="brand-outline px-3 py-1.5 rounded text-sm">Log in</a>
          <a href="/signup" class="brand-cta px-3 py-1.5 rounded text-sm">Get Started</a>
        </div>

        <div class="md:hidden">
          <button id="nav-toggle-ct" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  <main class="max-w-4xl mx-auto px-6 py-16">
    <h1 class="text-3xl font-extrabold brand-heading">Contact Us</h1>
    <p class="mt-2 text-slate-700">Have a question, feedback, or want to collaborate? Send us a message and we'll get back to you.</p>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
      <form id="contact-form" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-slate-700">Name</label>
          <input id="name" type="text" required class="mt-1 block w-full border rounded px-3 py-2" />
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700">Email</label>
          <input id="email" type="email" required class="mt-1 block w-full border rounded px-3 py-2" />
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700">Subject</label>
          <input id="subject" type="text" class="mt-1 block w-full border rounded px-3 py-2" />
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700">Message</label>
          <textarea id="message" rows="6" required class="mt-1 block w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="flex items-center gap-3">
          <button type="submit" class="brand-cta px-4 py-2 rounded">Send Message</button>
          <div id="form-status" class="text-sm text-slate-700"></div>
        </div>
      </form>
    </div>
  </main>

  <footer class="text-center text-sm text-slate-600 py-8">&copy; 2025 CedarMind</footer>

  <script>
    document.getElementById('contact-form').addEventListener('submit', async function(e) {
      e.preventDefault();
      const statusEl = document.getElementById('form-status');
      statusEl.textContent = '';

      const payload = {
        name: document.getElementById('name').value.trim(),
        email: document.getElementById('email').value.trim(),
        subject: document.getElementById('subject').value.trim(),
        message: document.getElementById('message').value.trim()
      };

      if (!payload.name || !payload.email || !payload.message) {
        statusEl.textContent = 'Please fill the required fields.';
        return;
      }

      const token = localStorage.getItem('cedarmind_token');

      try {
        const res = await fetch('/api/contact', {
          method: 'POST',
          headers: Object.assign({ 'Content-Type': 'application/json' }, token ? { 'Authorization': 'Bearer ' + token } : {}),
          body: JSON.stringify(payload)
        });

        if (res.ok) {
          statusEl.textContent = 'Message sent — thank you!';
          document.getElementById('contact-form').reset();
        } else {
          const data = await res.json().catch(() => ({}));
          statusEl.textContent = data.message || 'Failed to send message.';
        }
      } catch (err) {
        statusEl.textContent = 'Network error — try again later.';
      }
    });
  </script>

</body>
</html>
