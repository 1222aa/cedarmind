<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>My Certificates - CedarMind</title>
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
          <a href="/certificates" class="brand-link text-[var(--cedar)]">Certificates</a>
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
        <a href="/certificates" class="brand-link-mobile block px-3 py-2 text-[var(--cedar)]">Certificates</a>
      </div>
    </div>
  </header>

  <main class="container-main py-8 px-6 max-w-6xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold brand-heading mb-2">My Certificates</h1>
      <p class="text-gray-600">Your earned certificates of completion from CedarMind courses.</p>
    </div>

    <!-- Certificates Grid -->
    <div id="certificatesContainer" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="text-center py-12">
        <i class="fas fa-spinner fa-spin text-4xl text-[var(--cedar)] mb-4"></i>
        <p class="text-gray-600">Loading certificates...</p>
      </div>
    </div>

    <!-- Empty State -->
    <div id="emptyCertificates" class="hidden text-center py-16">
      <i class="fas fa-award text-6xl text-gray-300 mb-4"></i>
      <h3 class="text-2xl font-bold text-gray-700 mb-2">No Certificates Yet</h3>
      <p class="text-gray-600 mb-6">Complete a course to earn your first certificate!</p>
      <a href="/courses" class="inline-block bg-[var(--cedar)] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[var(--cedar-dark)] transition">
        <i class="fas fa-book mr-2"></i>Browse Courses
      </a>
    </div>
  </main>

  <!-- Certificate Modal -->
  <div id="certificateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
      <div class="sticky top-0 bg-white border-b p-4 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Certificate Preview</h2>
        <button onclick="document.getElementById('certificateModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times text-2xl"></i>
        </button>
      </div>
      <div id="modalContent" class="p-6">
        <!-- Certificate preview will load here -->
      </div>
    </div>
  </div>

  <script>
    const token = localStorage.getItem('cedarmind_token');
    const user = localStorage.getItem('cedarmind_user');

    // Check authentication
    if (!token || !user) {
      window.location.href = '/login';
    }

    // Display user name
    try {
      const userData = JSON.parse(user);
      document.getElementById('userName').textContent = `Welcome, ${userData.name}!`;
    } catch (e) {
      console.error('Error parsing user data');
    }

    // Load certificates
    async function loadCertificates() {
      try {
        const response = await fetch('/api/certificates', {
          headers: { 'Authorization': `Bearer ${token}` }
        });

        if (response.status === 401) {
          localStorage.removeItem('cedarmind_token');
          localStorage.removeItem('cedarmind_user');
          window.location.href = '/login';
          return;
        }

        if (!response.ok) {
          throw new Error('Failed to load certificates');
        }

        const data = await response.json();
        console.log('Certificates loaded:', data);
        displayCertificates(data.certificates || []);
      } catch (error) {
        console.error('Error loading certificates:', error);
        document.getElementById('certificatesContainer').innerHTML = '<p class="text-red-500">Error loading certificates</p>';
      }
    }

    function displayCertificates(certificates) {
      const container = document.getElementById('certificatesContainer');
      
      if (!certificates || certificates.length === 0) {
        container.classList.add('hidden');
        document.getElementById('emptyCertificates').classList.remove('hidden');
        return;
      }

      container.innerHTML = '';
      certificates.forEach(cert => {
        const certDiv = document.createElement('div');
        certDiv.className = 'bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-[var(--cedar)]';
        certDiv.innerHTML = `
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <i class="fas fa-certificate text-4xl text-amber-500"></i>
              <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">Earned</span>
            </div>
            <h3 class="text-lg font-bold brand-heading mb-2 truncate">${cert.course_title}</h3>
            <p class="text-sm text-gray-600 mb-4">
              <i class="fas fa-calendar mr-1"></i>
              ${cert.earned_at}
            </p>
            <p class="text-xs text-gray-500 mb-4 font-mono">Cert #: ${cert.certificate_number}</p>
            <div class="flex gap-2">
              <button onclick="downloadCertificate(${cert.id})" class="flex-1 bg-[var(--cedar)] text-white py-2 rounded font-semibold hover:bg-[var(--cedar-dark)] transition text-sm">
                <i class="fas fa-download mr-1"></i>Download
              </button>
              <button onclick="viewCertificate(${cert.id})" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded font-semibold hover:bg-gray-200 transition text-sm">
                <i class="fas fa-eye mr-1"></i>Preview
              </button>
            </div>
          </div>
        `;
        container.appendChild(certDiv);
      });
    }

    async function downloadCertificate(certId) {
      console.log('Downloading certificate:', certId);
      try {
        const response = await fetch(`/api/certificates/${certId}/download`, {
          headers: { 'Authorization': `Bearer ${token}` }
        });

        console.log('Download response status:', response.status);
        if (response.ok) {
          const blob = await response.blob();
          console.log('Blob size:', blob.size);
          const url = window.URL.createObjectURL(blob);
          const a = document.createElement('a');
          a.href = url;
          a.download = `certificate.pdf`;
          document.body.appendChild(a);
          a.click();
          window.URL.revokeObjectURL(url);
          a.remove();
        } else {
          const errorText = await response.text();
          console.error('Download error:', response.status, errorText);
          alert('Error downloading certificate: ' + response.status);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Error downloading certificate: ' + error.message);
      }
    }

    function viewCertificate(certId) {
      // Open certificate modal
      document.getElementById('certificateModal').classList.remove('hidden');
      document.getElementById('modalContent').innerHTML = `
        <div class="text-center py-8">
          <i class="fas fa-certificate text-6xl text-amber-500 mb-4"></i>
          <h3 class="text-xl font-bold mb-4">Certificate Preview</h3>
          <p class="text-gray-600 mb-6">Certificate ID: ${certId}</p>
          <p class="text-sm text-gray-500">PDF preview requires downloading the file.</p>
        </div>
      `;
    }

    // Logout
    document.getElementById('logoutBtn').addEventListener('click', async () => {
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

    // Mobile menu
    document.getElementById('nav-toggle').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Initialize
    loadCertificates();
  </script>

</body>

</html>
