<?php
interface Adivinador
 {
public function sugerirNumeroSecreto();
  public function elNumeroEraMenor();
  public function elNumeroEraMayor();
}
class
Principiante implements Adivinador
 {
  protected $minimo = 1;
  protected $maximo = 1000;
  protected $sugerencia = 0;
  public function __construct($minimo, $maximo) {
    $this→minimo = $minimo;
    $this→maximo = $maximo;
}
  public function sugerirNumeroSecreto()
{
    $aleatorio = (int)rand($this->minimo, $this->maximo);
    $this->sugerencia = $aleatorio;
    return $this->sugerencia;
  }
  public function elNumeroEraMayor()
 {
    $this->minimo = $this->sugerencia;
  }
  public function elNumeroEraMenor()
  {
    $this->maximo = $this->sugerencia;
  }
}
class Profesionar extends Principiante {
public function sugerirNumeroSecreto() {
$this->sugerencia = (int)(($this→minimo + $this→maximo) / 2);
return $this->sugerencia;
}
}

class Juego
 {
  protected $ganador = '';
  protected $rondas = 0;
  public function jugar(Adivinador $jugador1, Adivinador $jugador2) 
{
    $this->rondas = 0;
    $this->ganador = '';
    $numSecreto = rand(1, 1000);
    while ($this->ganador == '') 
    {
      $num1 = $jugador1->sugerirNumeroSecreto();
      $num2 = $jugador2->sugerirNumeroSecreto();
      if ($this->hayGanador($numSecreto, $num1, $num2) == false)
     {
        $this->informarDesvio($jugador1, $num1, $numSecreto);
        $this->informarDesvio($jugador2, $num2, $numSecreto);
     }
      $this->rondas++;
    }
    return $this->ganador;
  }
  protected function hayGanador($numSecreto, $num1, $num2)
  {
    if ($num1 == $numSecreto || $num2 == $numSecreto) {
      if ($num1 == $num2) {
        $this->ganador = 'Ambos jugadores empataron.';
      }
      elseif ($num1 == $numSecreto) {
        $this->ganador = 'Ganó el jugador 1.';
      }
      else {
        $this->ganador = 'Ganó el jugador 2.';
      }
      return true; // Alguno de los jugadores acertó, devolvemos true.
    }
    return false;  // Ningún jugador acertó, devolvemos false.
  }
 protected function informarDesvio(Adivinador $jugador, $numero, $numeroSecreto)
 {
if ($numero > $numeroSecreto) {
    $jugador→elNumeroEraMayor();
}
else {
    $jugador→elNumeroEraMenor();
    }
}
}

$juego = new Juego;
$gano1 = $gano2 = 0;
for ($i = 1; $i < 15; $i++) {
$jugador1 = new Principiante;
$jugador2 = new Principiante;
$resultadoJuego = $juego→jugar($jugador1, $jugador2);
if ($resultadoJuego == "Ganó el jugador 1") {
$gano1++;
}
elseif ($resultadoJuego == "Ganó el jugador 2") {
$gano2++;
}
echo $resultadoJuego;
}
if ($gano1 == $gano2) {
echo 'Hubo un empate en el torneo';
}
elseif ($gano1 > $gano2) {
echo 'Gano el torneo el jugador 1';
}
else {
echo 'Gano el torneo el jugador 2';
}
