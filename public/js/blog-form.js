document.addEventListener('DOMContentLoaded', function() {
  const wrapper = document.getElementById('authors-wrapper');
  const addBtn  = document.getElementById('add-author');

  const tmpl    = document.getElementById('author-row-template').content;

  const MAX = 5;


  function refreshAddBtn(){
    const count = wrapper.querySelectorAll('.author-row').length;
    addBtn.disabled = count >= MAX;
  }

  refreshAddBtn();

  // Add a new author row
  addBtn.addEventListener('click', () => {
    //Check if max count has been reached when adding another author
    const count = wrapper.querySelectorAll('.author-row').length;
    if(count >= MAX){
      alert(`You can add only up to ${MAX} authors.`);
      return;
    }
    // document.importNode(template.content, true) creates a deep clone
    const clone = document.importNode(tmpl, true);
    wrapper.appendChild(clone);
  });

  // Remove an author row (event delegation)
  wrapper.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-author')) {
      const row = e.target.closest('.author-row');
      if (row) {
        row.remove();
      }
    }
  });
});
