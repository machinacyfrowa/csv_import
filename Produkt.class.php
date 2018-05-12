<?php
class Produkt {
  private $ean;
  private $nazwa;
  private $ilosc;
  private $cena;
  private $producent;

  public function __construct($linia) { //linia z pliku csv
    $pola = explode(";",$linia);
    //$pola[0] to id hurtowni
    $this->ean = $pola[1];
    $this->nazwa = $pola[2];
    if(intval($pola[3]) > 1)
      $this->ilosc = $pola[3] - 1;
    else $this->ilosc = 0;
    $this->cena = floatval($pola[6]);
    $this->producent = $pola[7];
  }
}
?>
