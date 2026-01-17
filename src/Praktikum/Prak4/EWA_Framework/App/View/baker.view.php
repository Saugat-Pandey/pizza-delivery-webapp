<?php require 'App/View/partials/head.php'; ?>

<main>
    <h1>Bäcker - Offene Pizzen</h1>

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
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th>Bestell Nr.</th>
                    <th>Pizza</th>
                    <th>Adresse</th>
                    <th>Bestellzeit</th>
                    <th>Aktueller Status</th>
                    <th>Status ändern</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pizzas'] as $row): ?>
                    <tr>
                        <td><?= (int) $row['ordering_id'] ?></td>
                        <td><?= htmlspecialchars($row['pizza_name']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['ordering_time']) ?></td>
                        <td><?= statusText((int) $row['status']) ?></td>
                        <td>
                            <form method="post" action="baker.php" style="display:inline;">
                                <input type="hidden" name="oa_id" value="<?= (int) $row['ordered_article_id'] ?>">

                                <select name="status" class="auto-submit">
                                    <option value="0" <?= $row['status'] == 0 ? 'selected' : '' ?>>Bestellt</option>
                                    <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>Im Ofen</option>
                                    <option value="2" <?= $row['status'] == 2 ? 'selected' : '' ?>>Fertig</option>
                                </select>
    
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Keine offenen Pizzen gefunden.</p>
    <?php endif; ?>
</main>

<?php require 'App/View/partials/footer.php'; ?>