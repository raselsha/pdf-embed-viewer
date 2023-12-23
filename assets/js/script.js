function view_pdf(path, initialDoc){
    // pdfjs express
    WebViewer({
        path: path, // path to the PDF.js Express'lib' folder on your server
        initialDoc: initialDoc,
        // initialDoc: '/path/to/my/file.pdf',  // You can also use documents on your server
    }, 
    document.getElementById('newsletter_file_viewer'));
}
