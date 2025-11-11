<?php require_once("head.php"); ?>
<main>
  <h2>Bäcker</h2>

  <section>
    <form action="https://echo.hofmann-thomas.de/" method="post">
      <article>
        <h3>Bestellung 100 Pizza Salami</h3>
        <label><input type="radio" name="b100" value="Bestellt"> Bestellt</label>
        <label><input type="radio" name="b100" value="Im Ofen"> Im Ofen</label>
        <label><input type="radio" name="b100" value="Fertig"> Fertig</label>
      </article>

      <article>
        <h3>Bestellung 101 Pizza Vegetaria</h3>
        <label><input type="radio" name="b101" value="Bestellt"> Bestellt</label>
        <label><input type="radio" name="b101" value="Im Ofen"> Im Ofen</label>
        <label><input type="radio" name="b101" value="Fertig"> Fertig</label>
      </article>

      <article>
        <h3>Bestellung 102 Pizza Schinken</h3>
        <label><input type="radio" name="b102" value="Bestellt"> Bestellt</label>
        <label><input type="radio" name="b102" value="Im Ofen"> Im Ofen</label>
        <label><input type="radio" name="b102" value="Fertig"> Fertig</label>
      </article>
      <br />
      <input type="submit" value="Status aktualisieren">
    </form>
  </section>
</main>
<?php require_once("footer.php"); ?>