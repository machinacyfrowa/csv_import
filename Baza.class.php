<?php
include 'Produkt.class.php';
class Baza
{
  private $produkty = [];
  private $plikCzytany;
  private $plikZapisywany;

  public function __construct($plikC, $plikZ) {
    $this->plikCzytany = $plikC;
    $this->plikZapisywany = $plikZ;
  }

  function otworzPlik() {
    $plik = fopen($this->plikCzytany, "r");
    while (!feof($plik)) {
      $linia = fgets($plik);
      $p = new Produkt($linia);
      if($p->produktPrawidlowy()) array_push($this->produkty, $p);
    }
    fclose($plik);
  }
  function ileProduktow() {
    return count($this->produkty);
  }
  function zapiszPlik() {
    $plik = fopen($this->plikZapisywany, "w");
    $header = Array("sku", "name", "stock_quantity", "regular_price", "attribute1", "attribute1name", "status");
    fputcsv($plik, $header);
    foreach ($this->produkty as $produkt) {
      fputcsv($plik, $produkt->zwrocProdukt());
    }
    fclose($plik);
  }
}

?>
