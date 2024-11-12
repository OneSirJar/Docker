function FetchApi() {
    fetch = ('http://localhost:8000/prompt_fragments')
}
function performSearch() {
    const query = document.getElementById('searchInput').value;
    if (query) {
        alert('je hebt dit opgezocht:  ' + query);
    } else {
        alert('vul een zoekterm in');
    }
}

document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        performSearch();
    }
});