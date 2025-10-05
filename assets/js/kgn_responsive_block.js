document.addEventListener('DOMContentLoaded', () => {
  // Bail if we're in the WordPress editor
  if (document.body.classList.contains('block-editor-page') ||
      document.querySelector('.editor-styles-wrapper') ||
      window.wp?.blocks) {
    return;
  }

  const tokenBlock = document.querySelector('.token-info-block');

  if (!tokenBlock) return;

  const originalParent = tokenBlock.parentElement;
  const originalNextSibling = tokenBlock.nextElementSibling;

  function moveTokenBlock() {
    // Double-check we're not in the editor before manipulating DOM
    if (document.body.classList.contains('block-editor-page')) {
      return;
    }

    const screenWidth = window.innerWidth;
    const allH2Elements = document.querySelectorAll('h2');
    const secondH2Element = allH2Elements.length > 1 ? allH2Elements[1] : null;

    if (screenWidth < 1030) {
      if (tokenBlock && secondH2Element && secondH2Element.parentElement) {
        if (!secondH2Element.parentElement.contains(tokenBlock)) {
          secondH2Element.parentElement.insertBefore(tokenBlock, secondH2Element);
        }
      }
    } else {
      if (originalParent && !originalParent.contains(tokenBlock)) {
        if (originalNextSibling && originalNextSibling.parentElement) {
          originalParent.insertBefore(tokenBlock, originalNextSibling);
        } else {
          originalParent.appendChild(tokenBlock);
        }
      }
    }
  }

  // Initial check
  moveTokenBlock();

  // Listen for resize events
  window.addEventListener('resize', moveTokenBlock);
});
