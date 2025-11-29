<?php require 'App/View/partials/head.php'; ?>

<main>
    <section>
        <h2>Speisekarte</h2>

        <?php if (!empty($data['menu'])): ?>
            <?php foreach ($data['menu'] as $pizza): ?>
                <article>
                    <img src="assets/images/<?= htmlspecialchars($pizza['picture']) ?>"
                        alt="<?= htmlspecialchars($pizza['name']) ?>" width="100">

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

        <form action="index.php" method="post">

            <label for="adresse">Adresse:</label><br>
            <input type="text" name="adresse" placeholder="Adresse eingeben" required><br>

            <label for="cart">Ihre Auswahl:</label><br>

            <select id="cart" name="pizzas[]" size="4" multiple required>

                <?php if (!empty($data['menu'])): ?>
                    <?php foreach ($data['menu'] as $pizza): ?>
                        <option value="<?= $pizza['article_id'] ?>">
                            <?= htmlspecialchars($pizza['name']) ?>
                            (<?= number_format($pizza['price'], 2) ?> €)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <p>Gesamtpreis: —</p>
            
            <div>
                <button type="button" onclick="document.getElementById('cart').selectedIndex = -1;">
                    Auswahl Löschen
                </button>

                <button type="reset">Alle Löschen</button>

                <button type="submit">Bestellen</button>
            </div>

        </form>
    </section>

</main>

<?php require 'App/View/partials/footer.php'; ?>