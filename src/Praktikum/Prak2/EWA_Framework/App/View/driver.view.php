<?php 
require_once("partials/head.php"); 

$orders =$data['orders']?? [];
?>

<main>
  <h2>Fahrer</h2>

  <section>
    <?php if (empty($orders)): ?>
      <p>Aktuell liegen keine Offenen Bestellungen vor. </p>

      <?php else : ?>
        <form action="driver.php" method="post">
          <?php foreach ($orders as $order): ?>
             <article>
                <h3>Bestellung <?=htmlspecialchars((string)$order['ordering_id']) ?></h3>
                <p><?= htmlspecialchars($order['address']) ?> </p>
                <p>
                   <?= htmlspecialchars(implode(',' , $order['articles'])) ?>
                </p>
                
                <?php 
                $currentStatus=(int)($order['status']??0);
                ?>

                <label>
                <input type="radio" 
                 name="status[<?= (int)$order['ordering_id'] ?>]"
                 value="fertig"
                 <?= $currentStatus ===2 ? 'checked' :''?>>
                fertig
                </label>
        
                <label>
                <input type="radio" 
                 name="status[<?= (int)$order['ordering_id'] ?>]"
                 value="unterwegs"
                 <?= $currentStatus === 3 ? 'checked' : '' ?>>
                 unterwegs
                
                </label>

                <label>
                <input type="radio" 
                 name="status[<?= (int)$order['ordering_id'] ?>]"
                 value="geliefert">
                geliefert
                </label>

              </article>
      <?php endforeach; ?>
      <input type="submit" value="Status aktualisieren">
        </form>
          <?php endif; ?>


    </section>
    </main>

    <?php 
    require_once("partials/footer.php");
    ?>