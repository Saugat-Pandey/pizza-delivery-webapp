<?php 

$orders = $data['orders'] ?? [];
require_once("partials/head.php"); 
?>

<main>
<section>
    <h2>Kunde(Lieferstatus)</h2>

    <?php if(empty($orders)): ?>
        <p>Keine Bestellungen vorhanden. </p>
        <?php else: ?>

          <?php 

          $grouped =[];
          foreach($orders as $row){
            $grouped[$row['ordering_id']][]= $row;
          }
          ?>
        
        <?php foreach($grouped as $orderId => $items): ?>
            <article>
                <h3>Bestellung <?= $orderId ?> </h3>

                <?php foreach($items as $item): ?>
                    <p>
                    <?= htmlspecialchars($item['article_name']) ?>
                    <strong>
                     <?php 
                      switch((int)$item['status']){
                        case 0: echo "bestellt"; break;
                        case 1: echo "im Ofen"; break;
                        case 2: echo "fertig";break;
                        case 3: echo "unterwegs";break;
                        case 4: echo "geliefert";break;
                        default: echo "Ubnekannt"; break;

                      }

                      ?>
                      </strong>
                    </p>
                <?php endforeach; ?>
             </article>
         <?php endforeach; ?>

     <?php endif; ?>

    <form action="index.php" method="get">
        <button type="submit" >Neue Bestellung</button>
    </form>
            
</section>

</main>
                    
                    
<?php 
 require_once("partials/footer.php");
?>
