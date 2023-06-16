const searchInput = document.getElementById('searchInput');

  // Add event listener for input changes
  searchInput.addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const cards = document.querySelectorAll('.card');

    cards.forEach(function(card) {
      const title = card.querySelector('.card__title').textContent.toLowerCase();
      if (title.includes(searchValue)) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  });