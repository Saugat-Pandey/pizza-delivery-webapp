<?php require_once("head.php"); ?>
<main>
  <section>
    <h2>Kunde (Lieferstatus)</h2>

    <article>
      <p>Salami: <strong>Im Ofen</strong></p>
      <p>Vegetaria: <strong>fertig</strong></p>
      <p>Schinken: <strong>bestellt</strong></p>
    </article>

    <form action="bestellung.php" method="get">
      <button type="submit">Neue Bestellung</button>
    </form>
  </section>
</main>
<?php require_once("footer.php"); ?>
