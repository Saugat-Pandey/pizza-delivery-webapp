<?php require_once("head.php"); ?>
<main>
  <h2>Fahrer</h2>

  <section>
    <form action="https://echo.hofmann-thomas.de/" method="post">
      <article>
        <h3>Bestellung 100</h3>
        <p>Alfred-Messel-Weg 10C, 64287 Darmstadt</p>
        <p>Salami, Schinken</p>
        <label><input type="radio" name="b100" value="Fertig"> Fertig</label>
        <label><input type="radio" name="b100" value="Unterwegs"> Unterwegs</label>
        <label><input type="radio" name="b100" value="Geliefert"> Geliefert</label>
      </article>

      <article>
        <h3>Bestellung 102</h3>
        <p>Goethestraße 41, 63465 Darmstadt</p>
        <p>Vegetaria</p>
        <label><input type="radio" name="b102" value="Fertig"> Fertig</label>
        <label><input type="radio" name="b102" value="Unterwegs"> Unterwegs</label>
        <label><input type="radio" name="b102" value="Geliefert"> Geliefert</label>
      </article>
      <br />
      <input type="submit" value="Status aktualisieren" />
    </form>

  </section>
</main>
<?php require_once("footer.php"); ?>