<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'Page') ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
    <?php if (!empty($isCustomerPage)): ?>
        <script src="assets/js/customer.js" defer></script>
    <?php endif; ?>
</head>

<body>
    <header class="site-header">
        <div class="header-inner">
            <div class="brand">
                <h1>PizzaExpress</h1>
                <p>Frisch gebacken - direkt zu dir!</p>
            </div>
        </div>

        <nav class="main-nav">
            <a href="index.php" class="active">Bestellung</a>
            <a href="customer.php">Kunde</a>
            <a href="baker.php">Bäcker</a>
            <a href="driver.php">Fahrer</a>
        </nav>
    </header>