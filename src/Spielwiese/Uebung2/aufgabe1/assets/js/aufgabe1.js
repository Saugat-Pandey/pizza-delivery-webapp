console.log("JS loaded");

async function requestData() {
    try {
        const response = await fetch('api.php');
        if (!response.ok) throw new Error('Netzwerkantwort war nicht ok');

        const data = await response.json();

        if (!data) {
            console.error('Dokument ist leer');
            return;
        }
        process(data);
    } catch (error) {
        console.error('Übertragung fehlgeschlagen:', error);
    }
}

function process(data) {
    const container = document.getElementById("output");
    container.innerHTML = "";

    const ul = document.createElement("ul");

    data.forEach(item => {
        const li = document.createElement("li");
        li.textContent = `${item.id} - ${item.name} - ${item.created_at}`;

        ul.appendChild(li);
    });

    container.appendChild(ul);
}

document.addEventListener('DOMContentLoaded', () => {
    requestData();
})