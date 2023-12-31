function view_pdf(path, initialDoc){
    // pdfjs express
    WebViewer({
        path: path, // path to the PDF.js Express'lib' folder on your server
        initialDoc: initialDoc,
        // initialDoc: '/path/to/my/file.pdf',  // You can also use documents on your server
    }, 
    document.getElementById('newsletter_file_viewer'));
}

// ============custom data tabs===========

const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget)
    tabContents.forEach(tabContent => {
      tabContent.classList.remove('active')
    })
    tabs.forEach(tab => {
      tab.classList.remove('active')
    })
    tab.classList.add('active')
    target.classList.add('active')
  })
})


// ============admin scripts===========

jQuery(document).ready(function($){
  $('.color-field').wpColorPicker();
});
