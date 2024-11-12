function FetchApi() {
    fetch = ('')
}
function performSearch() {
    const query = document.getElementById('searchInput').value;
    if (query) {
        alert('You searched for: ' + query);
    } else {
        alert('Please enter a search term');
    }
}

document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        performSearch();
    }
});