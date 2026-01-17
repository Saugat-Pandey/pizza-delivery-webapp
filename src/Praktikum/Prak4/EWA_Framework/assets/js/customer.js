async function requestData() {
    try {
        const response = await fetch('statusApi.php');

        if (!response.ok) {
            throw new Error(`Fehler: ${response.status}`);
        }

        const data = await response.json();
        process(data);
    } catch (error) {
        console.error("Übertragung fehlgeschlagen:", error);
    }
}

function process(data) {
    const container = document.getElementById("order-status");

    if (!container || !data.hasOrder) {
        return;
    }

    container.innerHTML = "";

    data.orders.forEach(item => {
        const p = document.createElement("p");
        p.textContent = `${item.pizza_name} - ${statusText(Number(item.status))}`;
        container.appendChild(p);
    });
}

function statusText(status) {
    switch (status) {
        case 0: return "bestellt";
        case 1: return "im Ofen";
        case 2: return "fertig";
        case 3: return "unterwegs";
        case 4: return "geliefert";
        default: return "unbekannt";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    requestData();
    window.setInterval(requestData, 2000);
})