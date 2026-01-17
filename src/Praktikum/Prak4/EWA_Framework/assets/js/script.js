document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("order-form");

    if (form) {
        const cart = document.getElementById("cart");
        const addressInput = form.querySelector('input[name="adresse"]');
        const deleteSelectedBtn = document.getElementById("delete-selected");
        const deleteAllBtn = document.getElementById("delete-all");
        const pizzaImages = document.querySelectorAll(".pizza-image");

        pizzaImages.forEach(img => {
            img.addEventListener("click", () => {
                const pizzaId = img.dataset.articleId;
                const pizzaName = img.dataset.articleName;
                const pizzaPrice = Number(img.dataset.articlePrice);

                const option = document.createElement("option");
                option.value = pizzaId;
                option.dataset.price = pizzaPrice;
                option.textContent = `${pizzaName} (${pizzaPrice.toFixed(2)} €)`;
                // option.selected = true;

                cart.appendChild(option);

                updateTotalPrice();
                updateOrderButtonState();
            });
        });

        cart.addEventListener("change", () => {
            updateTotalPrice();
            updateOrderButtonState();
        });

        deleteSelectedBtn?.addEventListener("click", () => {
            Array.from(cart.selectedOptions).forEach(option => option.remove());
            updateTotalPrice();
            updateOrderButtonState();
        });

        deleteAllBtn?.addEventListener("click", () => {
            cart.innerHTML = "";
            updateTotalPrice();
            updateOrderButtonState();
        });

        form.addEventListener("submit", (event) => {
            const addressFilled = addressInput.value.trim().length > 0;
            const hasPizza = cart.options.length > 0;

            if (!addressFilled || !hasPizza) {
                event.preventDefault();
                alert("Bitte Adresse eingeben und mindestens eine Pizza auswählen.");
                return;
            }

            Array.from(cart.options).forEach(option => option.selected = true);
        });

        addressInput.addEventListener("input", updateOrderButtonState);

        updateTotalPrice();
        updateOrderButtonState();
    }

    const autoSubmitInputs = document.querySelectorAll(".auto-submit");

    autoSubmitInputs.forEach(input => {
        input.addEventListener("change", () => {
            const form = input.closest("form");
            if (form) {
                form.submit();
            }
        });
    });

});

function updateTotalPrice() {
    const cart = document.getElementById("cart");
    const totalPriceEl = document.getElementById("total-price");
    if (!cart || !totalPriceEl) return;

    let total = 0;
    Array.from(cart.options).forEach(option => {
        total += parseFloat(option.dataset.price);
    });

    totalPriceEl.textContent = total.toFixed(2) + " €";
}

function updateOrderButtonState() {
    const addressInput = document.querySelector('input[name="adresse"]');
    const cart = document.getElementById("cart");
    const orderBtn = document.getElementById("order-btn");
    if (!addressInput || !cart || !orderBtn) return;

    const addressFilled = addressInput.value.trim().length > 0;
    const hasPizza = cart.options.length > 0;

    orderBtn.disabled = !(addressFilled && hasPizza);
}
