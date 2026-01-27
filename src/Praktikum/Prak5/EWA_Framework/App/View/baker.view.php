<?php require 'App/View/partials/head.php'; ?>

<main class="baker-page">
    <h1>Bäcker</h1>

    <?php if (isset($_GET['message']) && $_GET['message'] === 'updated'): ?>
        <p style="color: green;">Status wurde aktualisiert.</p>
    <?php endif; ?>

    <?php
    function statusText(int $s): string
    {
        return match ($s) {
            0 => 'Bestellt',
            1 => 'Im Ofen',
            2 => 'Fertig',
            default => 'Unbekannt',
        };
    }
    ?>

    <?php if (!empty($data['pizzas'])): ?>
        <?php
        $orders = [];
        foreach ($data['pizzas'] as $row) {
            $orders[$row['ordering_id']][] = $row;
        }
        ?>
        <section class="baker-list">
            <?php foreach ($orders as $orderingId => $pizzas): ?>
                <section class="baker-order">
                    <p class="baker-order__title">Bestellnummer: #<?= (int) $orderingId ?></p>

                    <div class="baker-order__pizzas">
                        <?php foreach ($pizzas as $row): ?>
                            <article class="baker-card">
                                <figure class="baker-card__pizza">
                                    <?php if (!empty($row['pizza_picture'])): ?>
                                        <img
                                            src="assets/images/<?= htmlspecialchars($row['pizza_picture']) ?>"
                                            alt="<?= htmlspecialchars($row['pizza_name']) ?>">
                                    <?php endif; ?>
                                    <figcaption><?= htmlspecialchars($row['pizza_name']) ?></figcaption>
                                </figure>

                                <form method="post" action="baker.php" class="baker-card__actions">
                                    <input type="hidden" name="oa_id" value="<?= (int) $row['ordered_article_id'] ?>">

                                    <select name="status" class="auto-submit">
                                        <option value="0" <?= $row['status'] == 0 ? 'selected' : '' ?>>Bestellt</option>
                                        <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>Im Ofen</option>
                                        <option value="2" <?= $row['status'] == 2 ? 'selected' : '' ?>>Fertig</option>
                                    </select>
                                </form>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <p>Keine offenen Pizzen gefunden.</p>
    <?php endif; ?>
</main>

<?php require 'App/View/partials/footer.php'; ?>
