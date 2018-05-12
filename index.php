<?php
include 'Baza.class.php';
$b = new Baza("towary.csv", "wyjscie.csv");
$b->otworzPlik();
echo "<pre>";
echo $b->ileProduktow();
?>
