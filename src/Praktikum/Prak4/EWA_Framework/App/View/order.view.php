<?php require 'App/View/partials/head.php'; ?>

<main>
    <section>
        <h2>Speisekarte</h2>

        <?php if (!empty($data['menu'])): ?>
            <?php foreach ($data['menu'] as $pizza): ?>
                <article>
                    <img src="assets/images/<?= htmlspecialchars($pizza['picture']) ?>"
                        alt="<?= htmlspecialchars($pizza['name']) ?>" width="100" class="pizza-image"
                        data-article-id="<?= (int) $pizza['article_id'] ?>" 
                        data-article-name="<?= htmlspecialchars($pizza['name']) ?>"
                        data-article-price="<?= (float) $pizza['price'] ?>">

                    <p><?= htmlspecialchars($pizza['name']) ?></p>

                    <p>- <?= number_format($pizza['price'], 2) ?> € -</p>
                </article>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Keine Pizzen vorhanden.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2>Warenkorb</h2>

        <form action="index.php" method="post" id="order-form">

            <label for="adresse">Adresse:</label><br>
            <input type="text" name="adresse" placeholder="Adresse eingeben"><br>

            <label for="cart">Ihre Auswahl:</label><br>

            <select id="cart" name="pizzas[]" multiple>

            </select>

            <p>Gesamtpreis: <span id="total-price">0.00 €</span></p>

            <div>
                <button type="button" id="delete-selected">
                    Auswahl Löschen
                </button>

                <button type="button" id="delete-all">
                    Alle Löschen
                </button>

                <button type="submit" id="order-btn" disabled>Bestellen</button>
            </div>

        </form>
    </section>

</main>

<?php require 'App/View/partials/footer.php'; ?>