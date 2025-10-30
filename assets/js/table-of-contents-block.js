document.addEventListener("DOMContentLoaded", function () {
  let content = document.querySelector('.article-block');

  const tablesOfContent = document.querySelectorAll('.table-of-contents');

  tablesOfContent.forEach(tableOfContent => {
    let snippetList = tableOfContent.querySelector('.table-of-contents__list');
    snippetList.style.display = 'none';

    const toggleButton = tableOfContent.querySelector('.table-of-contents__button');

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

  const titles = content.querySelectorAll('h2.wp-block-heading');
  const navigations = document.querySelectorAll('.table-of-contents__list');

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

