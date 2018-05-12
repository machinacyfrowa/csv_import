<?php
include 'Produkt.class.php';
$csv = "5365;9500733054895;Zabawka dmuchana robot 1610G;76.0000;szt.;2.2900;2.8200;PODSTAWOWA;";
$p = new Produkt($csv);
echo "<pre>";
var_dump($p);
 ?>
