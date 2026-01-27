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
        const card = document.createElement("article");
        card.className = "status-card";

        const img = document.createElement("img");
        img.className = "status-card__image";
        const rawPicture = item.pizza_picture || "";
        if (rawPicture.startsWith("assets/") || rawPicture.startsWith("/")) {
            img.src = rawPicture;
        } else if (rawPicture) {
            img.src = `assets/images/${rawPicture}`;
        } else {
            img.src = "assets/images/logo.png";
        }
        img.alt = item.pizza_name;

        const name = document.createElement("h3");
        name.className = "status-card__name";
        name.textContent = item.pizza_name;

        const button = document.createElement("button");
        button.type = "button";
        button.className = "status-pill";
        button.textContent = statusText(Number(item.status));

        card.appendChild(img);
        card.appendChild(name);
        card.appendChild(button);
        container.appendChild(card);
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
