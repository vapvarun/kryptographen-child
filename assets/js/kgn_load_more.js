document.addEventListener('DOMContentLoaded', () => {
  const loadMoreBtn = document.querySelector('.kgn_load_more');

  if (!loadMoreBtn) return;

  loadMoreBtn.addEventListener('click', (e) => {
    e.preventDefault();

    const button = e.target;

    const form = new FormData();
    form.append('action', 'kgn_load_more');
    form.append('query', load_more_params.posts);
    form.append('page', load_more_params.current_page);

    fetch(load_more_params.ajax_url, {
      method: 'POST',
      body: form
    }).then(response => response.json()).then(data => {
      if( data.data ) {
        const parser = new DOMParser();

        const articles = parser.parseFromString(data.data.html, 'text/html').querySelectorAll('article');

        articles.forEach(article => {
          document.querySelector('.category-post-wrapper').appendChild(article);
        });
        load_more_params.current_page++

        if ( load_more_params.current_page == load_more_params.max_page ) {
          button.remove()
        }
      } else {
        button.remove()
      }
    })
  });
});
