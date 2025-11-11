<?php
// Der Unterstrich in Einwohnerzahl ist einfach eine Lesbarkeits¬hilfe in PHP 
$data = [
    0 => [
        'Land' => 'Deutschland',
        'Einwohnerzahl' => 84_000_000,
    ],
    1 => [
        'Land' => 'Polen',
        'Einwohnerzahl' => 38_000_000,
    ],
    2 => [
        'Land' => 'Frankreich',
        'Einwohnerzahl' => 65_000_000,
    ],
];

foreach ($data as $value) {
    echo "Land: " . $value['Land'] . "<br>";
    echo "Einwohnerzahl: " . $value['Einwohnerzahl'] . "<br><br>";
}
