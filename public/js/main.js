 // Toggle mobile menu (uses Tailwind `hidden` class)
    (function() {
      const btn = document.getElementById('nav-toggle');
      const menu = document.getElementById('mobile-menu');

      if (!btn || !menu) return;

      btn.addEventListener('click', function(e) {
        const expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', (!expanded).toString());
        menu.classList.toggle('hidden');
      });

      // Close when clicking outside
      document.addEventListener('click', (e) => {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
          if (!menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
          }
        }
      });
    })();

    