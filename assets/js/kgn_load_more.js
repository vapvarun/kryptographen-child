document.addEventListener('DOMContentLoaded', () => {
  // Bail if we're in the WordPress editor
  if (document.body.classList.contains('block-editor-page') ||
      document.querySelector('.editor-styles-wrapper') ||
      window.wp?.blocks) {
    return;
  }

  const loadMoreBtn = document.querySelector('.kgn_load_more');

  if (!loadMoreBtn) return;

  // Check if load_more_params is defined
  if (typeof load_more_params === 'undefined') {
    console.warn('KGN Load More: load_more_params not found');
    return;
  }

  loadMoreBtn.addEventListener('click', (e) => {
    e.preventDefault();

    const button = e.target;
    const categoryWrapper = document.querySelector('.category-post-wrapper');

    if (!categoryWrapper) {
      console.warn('KGN Load More: category-post-wrapper not found');
      return;
    }

    const form = new FormData();
    form.append('action', 'kgn_load_more');
    form.append('query', load_more_params.posts);
    form.append('page', load_more_params.current_page);
    form.append('nonce', load_more_params.nonce);

    fetch(load_more_params.ajax_url, {
      method: 'POST',
      body: form
    }).then(response => response.json()).then(data => {
      if (data.data) {
        const parser = new DOMParser();
        const articles = parser.parseFromString(data.data.html, 'text/html').querySelectorAll('article');

        articles.forEach(article => {
          categoryWrapper.appendChild(article);
        });

        load_more_params.current_page++;

        if (load_more_params.current_page == load_more_params.max_page) {
          button.remove();
        }
      } else {
        button.remove();
      }
    }).catch(error => {
      console.error('KGN Load More error:', error);
    });
  });
});
