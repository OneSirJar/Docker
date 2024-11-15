document.addEventListener('DOMContentLoaded', () => {
    const promptTemplate = document.getElementById('prompt-option');
    const promptOptionsDisplay = document.getElementById('prompt-options-display');
    const promptTitleElement = document.getElementById('prompt-title');
    const promptTextarea = document.getElementById('prompt');
    const askButton = document.getElementById('askChatGPT');
    const saveButton = document.getElementById('saveNewPrompt');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search-button');
    const tagsDropdown = document.getElementById('tags');

    const fetchPrompts = (query = '', tag = '') => {
        let url = `http://localhost:8000/composite_prompts`;
        if (query || tag) {
            url += `?query=${encodeURIComponent(query)}&tag=${encodeURIComponent(tag)}`;
        }
        fetch(url)
            .then(response => response.json())
            .then(composite_prompts => {
                promptOptionsDisplay.innerHTML = ''; // Clear previous prompts
                for (const composite_prompt of composite_prompts) {
                    const template = promptTemplate.content.cloneNode(true);
                    template.querySelector('h2').innerText = composite_prompt.title;
                    template.querySelector('p').innerText = composite_prompt.description;
                    template.querySelector('button').addEventListener('click', () => { selectPrompt(composite_prompt.id); });
                    promptOptionsDisplay.appendChild(template);
                }
            });
    };

    const selectPrompt = (promptId) => {
        fetch(`http://localhost:8000/composite_prompts/${promptId}/expanded`)
            .then(response => response.json())
            .then(prompt => {
                promptTextarea.value = prompt.fragments.reduce((acc, fragment) => {
                    return `${acc} \n\n${fragment.content}`;
                }, '');
            });
    };

    const performSearch = () => {
        const query = searchInput.value;
        const tag = tagsDropdown.value;
        fetchPrompts(query, tag);
    };

    fetchPrompts(); // Initial fetch

    askButton.addEventListener('click', () => {
        window.location.href = `https://chat.openai.com/?q=${encodeURIComponent(promptTextarea.value)}`;
    });

    saveButton.addEventListener('click', async () => {
        const newPrompt = await fetch(`http://localhost:8000/composite_prompts`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                "author_id": 1,
                "title": "New Prompt",
                "description": "default description"
            })
        }).then(response => response.json());

        const newFragment = await fetch(`http://localhost:8000/prompt_fragments`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                "author_id": 1,
                "content": promptTextarea.value,
                "description": "default description fragment",
            })
        }).then(response => response.json());

        fetch(`http://localhost:8000/composite_prompts/${newPrompt.id}/fragments/${newFragment.id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                "order_index": 0
            })
        });
    });

    searchButton.addEventListener('click', performSearch);
});
