<?php 
require_once("partials/head.php"); 

$orders = $data['orders'] ?? [];
?>

<main class="driver-page">
  <h1>Fahrer</h1>

  <section>
    <?php if (empty($orders)): ?>
      <p>Aktuell liegen keine offenen Bestellungen vor.</p>
    <?php else : ?>
      <form action="driver.php" method="post" id="driver-form">
        <?php foreach ($orders as $order): ?>
          <?php $currentStatus = (int)($order['status'] ?? 0); ?>
          <section class="driver-order">
            <p class="driver-order__title">Bestellnummer: #<?= (int)$order['ordering_id'] ?></p>

            <div class="driver-order__pizzas">
              <?php foreach ($order['articles'] as $article): ?>
                <figure class="driver-order__pizza">
                  <?php if (!empty($article['picture'])): ?>
                    <img
                      src="assets/images/<?= htmlspecialchars($article['picture']) ?>"
                      alt="<?= htmlspecialchars($article['name']) ?>">
                  <?php endif; ?>
                  <figcaption><?= htmlspecialchars($article['name']) ?></figcaption>
                </figure>
              <?php endforeach; ?>
            </div>

            <p class="driver-order__address">
              Adresse: <?= htmlspecialchars($order['address']) ?>
            </p>
            <p class="driver-order__total">
              Gesamtpreis: <?= number_format((float)$order['total_price'], 2) ?> €
            </p>

            <div class="driver-order__actions">
              <label class="driver-toggle">
                <input type="radio"
                  name="status[<?= (int)$order['ordering_id'] ?>]"
                  value="unterwegs"
                  class="auto-submit"
                  <?= $currentStatus === 3 ? 'checked' : '' ?>>
                <span>Unterwegs</span>
              </label>

              <label class="driver-toggle">
                <input type="radio"
                  name="status[<?= (int)$order['ordering_id'] ?>]"
                  value="geliefert"
                  class="auto-submit">
                <span>Ausgeliefert</span>
              </label>
            </div>
          </section>
        <?php endforeach; ?>
      </form>
    <?php endif; ?>
  </section>
</main>

<?php 
require_once("partials/footer.php");
?>
