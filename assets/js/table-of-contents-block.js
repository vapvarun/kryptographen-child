document.addEventListener("DOMContentLoaded", function () {
  // Bail if we're in the WordPress editor
  if (document.body.classList.contains('block-editor-page') ||
      document.querySelector('.editor-styles-wrapper') ||
      window.wp?.blocks) {
    return;
  }

  let content = document.querySelector('.article-block');

  const tablesOfContent = document.querySelectorAll('.table-of-contents');

  // Exit if no table of contents found
  if (!tablesOfContent.length) {
    return;
  }

  tablesOfContent.forEach(tableOfContent => {
    let snippetList = tableOfContent.querySelector('.table-of-contents__list');
    if (!snippetList) return;

    snippetList.style.display = 'none';

    const toggleButton = tableOfContent.querySelector('.table-of-contents__button');
    if (!toggleButton) return;

    toggleButton.addEventListener('click', (e) => {
      if (snippetList.style.display === 'none') {
        snippetList.style.display = 'block';
        toggleButton.innerHTML = 'Lukke Snarveier';
      } else {
        snippetList.style.display = 'none';
        toggleButton.innerHTML = 'Åpne Snarveier';
      }
    });
  });

  if (!content) {
    content = document.querySelector('.page-content');
  }

  // Exit if no content container found
  if (!content) {
    return;
  }

  const titles = content.querySelectorAll('h2.wp-block-heading');
  const navigations = document.querySelectorAll('.table-of-contents__list');

  // Exit if no titles found
  if (!titles.length) {
    return;
  }

  let navList = [];

  titles.forEach((title, idx) => {
    const titleId = `chapter-${idx}`;
    title.setAttribute('id', titleId);
    navList.push({'title': title.innerText, 'id': titleId});
  });

  navList.forEach(navItem => {
    navigations.forEach(navigation => {
      const listItem = document.createElement('li');
      const link = document.createElement('a');
      link.href = `#${navItem.id}`;
      link.textContent = navItem.title;
      listItem.appendChild(link);
      navigation.appendChild(listItem);

      listItem.addEventListener("click", (event) => {
        event.preventDefault();
        const title = document.getElementById(navItem.id);
        if (title) {
          smoothScrollToTitle(title);
        }
      });
    })
  });

  const smoothScrollToTitle = (element) => {
    const scrollOptions = {
      behavior: "smooth",
      top: element.offsetTop,
      duration: 2500
    };
    window.scrollTo(scrollOptions);
  };
});

