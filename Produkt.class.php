<?php
class Produkt {
  private $ean;
  private $nazwa;
  private $ilosc;
  private $cena;
  private $cenaDetaliczna;
  private $producent;
  private $narzuty = Array("ALEXANDER" => 0.2,
                            "ADAMIGO" => 0.2,
                            "AMI-PROMATEK" => 0.2,
                            "EGMONT" => 0.2,
                            "GRANNA" => 0.2,
                            "JAWA" => 0.2,
                            "FOKSAL" => 0.2);
  private $domyslnyNarzut = 0.3;

  public function __construct($linia) { //linia z pliku csv
    $pola = explode(";",$linia);
    //$pola[0] to id hurtowni
    $this->ean = $pola[1];
    $this->nazwa = $pola[2];
    if(intval($pola[3]) > 3)
      $this->ilosc = $pola[3] - 1;
    else $this->ilosc = 0;
    $this->cena = floatval($pola[6]);
    $this->producent = $pola[7];
    $this->obliczCene();
  }
  public function obliczCene() {
    if(isset($this->narzuty[$this->producent]))
      $this->cenaDetaliczna = $this->cena * (1 + $this->narzuty[$this->producent]);
    else $this->cenaDetaliczna = $this->cena * (1 + $this->domyslnyNarzut);
  }
}
?>
