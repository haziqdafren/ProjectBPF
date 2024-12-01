document.getElementById('theme-toggle').addEventListener('click', function() {
    const body = document.body;
    // Toggle between light and dark themes
    if (body.getAttribute('data-theme') === 'light-blue') {
        body.setAttribute('data-theme', 'dark-blue');
    } else {
        body.setAttribute('data-theme', 'light-blue');
    }
});
