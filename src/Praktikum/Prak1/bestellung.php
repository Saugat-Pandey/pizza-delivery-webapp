<?php
require_once("head.php");
?>

<main>
    <section>
        <h2>Speisekarte</h2>

        <article>
            <img src="images/pizza_salami.jpg" alt="Pizza Salami" width="100" />
            <p>Pizza Salami</p>
            <p>-8.57€-</p>
        </article>

        <article>
            <img src="images/pizza_vegetaria.png" alt="Pizza Vegetaria" width="100" />
            <p>Pizza Vegetaria</p>
            <p>-12.5€-</p>
        </article>

        <article>
            <img src="images/pizza_schinken.jpg" alt="Pizza Schinken" width="100" />
            <p>Pizza Schinken</p>
            <p>-11.99€-</p>
        </article>
    </section>

    <section>
        <h2>Warenkorb</h2>

        <form action="https://echo.hofmann-thomas.de" method="post">
            <label for="adresse">Adresse:</label><br />
            <input type="text" name="adresse" placeholder="Adresse eingeben" required /><br />

            <label for="cart">Ihre Auswahl:</label><br />
            <select id="cart" name="pizzas[]" size="4" multiple required>
                <option>Salami</option>
                <option>Schinken</option>
                <option>Vegetaria</option>
            </select>

            <p>Gesamtpreis: 32.55€</p>

            <div>
                <button type="button">Auswahl Löschen</button>
                <button type="reset">Alle Löschen</button>
                <button type="submit">Bestellen</button>
            </div>
        </form>
    </section>
</main>

<?php
require_once("footer.php");
?>