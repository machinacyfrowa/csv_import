<?php
class Produkt {
  private $ean;
  private $nazwa;
  private $ilosc;
  private $cena;
  private $cenaDetaliczna;
  private $producent;
  private $producenciUsunieci = Array("ADAR", "AGA", "ALIGA", "AMEET", "ANET",
                                      "ANPITO", "ANTON", "ARTYK", "BREWIS", "CZEMPOL",
                                    "GONZO", "INTERKOBO", "INTEX", "JAFI", "JANEX",
                                  "JASTRZĄBEK", "KLEIN", "KAMA", "LAZUR", "LEGO",
                                  "LEWANDOWSKI", "LITTLE TIKES", "LIWONA", "MALIMAS",
                                "MARGOS", "METREX", "MIDEX", "MIZ", "MONIKA", "MSTTOYS",
                              "PAW", "PIEROT", "POLSIRHURT", "PRESTIGE", "PROPEX", "REX",
                            "ROSA", "STARLET", "VIKING", "WAKART");
  private $narzuty = Array("ALEXANDER" => 0.2,
                            "ADAMIGO" => 0.2,
                            "AMI-PROMATEK" => 0.2,
                            "EGMONT" => 0.2,
                            "GRANNA" => 0.2,
                            "JAWA" => 0.2,
                            "FOKSAL" => 0.2,
                            "REBEL" => 0.2,
                            "REBEL-VCUBE" => 0.2,
                            "SIMBA" => 0.2,
                            "TACTIC" => 0.2,
                            "WINNING" => 0.2,
                            "TREFT" => 0.2);
  private $domyslnyNarzut = 0.3;

  public function __construct($linia) { //linia z pliku csv
    $pola = explode(";",$linia);
    if(count($pola) == 9) {
      //$pola[0] to id hurtowni
      $this->ean = $pola[1];
      $this->nazwa = $pola[2];
      $this->nazwa = iconv("windows-1250", "UTF-8", $this->nazwa);
      if(intval($pola[3]) > 3)
        $this->ilosc = $pola[3] - 1;
      else $this->ilosc = 0;
      $this->cena = floatval($pola[6]);
      $this->producent = $pola[7];
      $this->producent = iconv("windows-1250", "UTF-8", $this->producent);
      $this->obliczCene();
    }
  }
  public function obliczCene() {
    if(isset($this->narzuty[$this->producent]))
      $this->cenaDetaliczna = $this->cena * (1 + $this->narzuty[$this->producent]);
    else $this->cenaDetaliczna = $this->cena * (1 + $this->domyslnyNarzut);
  }
  public function produktPrawidlowy() { //zwraca true/false wg wymagan klienta
    //sprwdzamy poprawnosc kodu ean
    if (!preg_match("/^[0-9]{13}$/", $this->ean)) { //sprawdz czyma 13 cyfr
        return false;
    }
    //sprawdzamy producenta
    if(array_search($this->producent, $this->producenciUsunieci)) {
      return false;
    }
    return true;
  }
}
?>
