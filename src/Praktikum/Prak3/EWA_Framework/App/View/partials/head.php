<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Page') ?></title>
    
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body>
    <header>
        <h1>PizzaExpress</h1>
        <p>Frisch gebacken - direkt zu dir!</p>
        <nav>
            <a href="index.php">Bestellung</a>
            <a href="customer.php">Kunde</a>
            <a href="baker.php">Bäcker</a>
            <a href="driver.php">Fahrer</a>          
        </nav>
    </header>