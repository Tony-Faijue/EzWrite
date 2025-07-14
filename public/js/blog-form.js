document.addEventListener('DOMContentLoaded', function() {

  //-------------------Author Logic------------------
  
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
      refreshAddBtn();
  });

  // Remove an author row (event delegation)
  wrapper.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-author')) {
      const row = e.target.closest('.author-row');
      if (row) {
        row.remove();
      }
      refreshAddBtn();  
    }
  });

  //-------------------Topic Logic------------------
  const topicWrapper = document.getElementById('topics-wrapper');
  const addBtnTopic = document.getElementById('add-topic');
  const tmplTopic = document.getElementById('topic-row-template').content;
  const MAXTOPICROW  = 10;

  function refreshAddBtnTopic(){
      const count = topicWrapper.querySelectorAll('.topic-row').length;
    addBtnTopic.disabled = count >= MAXTOPICROW;
  }

  refreshAddBtnTopic();

  addBtnTopic.addEventListener('click', () => {
      const count = topicWrapper.querySelectorAll('.topic-row').length;
      if(count >= MAXTOPICROW){
        alert(`You can add only up to ${MAXTOPICROW} topics.`);
        return;
      }
      // document.importNode(template.content, true) creates a deep clone
      const clone = document.importNode(tmplTopic, true);
      topicWrapper.appendChild(clone);
        refreshAddBtnTopic();

    });

  topicWrapper.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-topic')) {
      const row = e.target.closest('.topic-row');
      if (row) {
        row.remove();
      }
      refreshAddBtnTopic();
    }
  });

});
