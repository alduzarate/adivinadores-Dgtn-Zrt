<?php

namespace adivinador;
use PHPUnit\Framework\TestCase;

interface Adivinador
 {
public function sugerirNumeroSecreto();
  public function elNumeroEraMenor();
  public function elNumeroEraMayor();
}
class Principiante implements Adivinador
 {
  protected $minimo = 1;
  protected $maximo = 1000;
  protected $sugerencia = 0;
 
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
class Profesional extends Principiante
{
public function sugerirNumeroSecreto() 
{
$this->sugerencia = (int)(($this->minimo + $this->maximo) / 2);
return $this->sugerencia;
}
}

class Juego
 {
  protected $ganador = '';
  protected $rondas = 0;
  public function jugar(Adivinador $jugador1, Adivinador $jugador2, Adivinador $jugador3, Adivinador $jugador4, Adivinador $jugador5, Adivinador $jugador6) 
{
    $this->rondas = 0;
    $this->ganador = '';
    $numSecreto = rand(1, 1000);
    while ($this->ganador == '') 
    {
      $num1 = $jugador1->sugerirNumeroSecreto();
      $num2 = $jugador2->sugerirNumeroSecreto();
      $num3 = $jugador1->sugerirNumeroSecreto();
      $num4 = $jugador2->sugerirNumeroSecreto();
      $num5 = $jugador1->sugerirNumeroSecreto();
      $num6 = $jugador2->sugerirNumeroSecreto();
      if ($this->hayGanador($numSecreto, $num1, $num2, $num3, $num4, $num5, $num6) == false)
     {
        $this->informarDesvio($jugador1, $num1, $numSecreto);
        $this->informarDesvio($jugador2, $num2, $numSecreto);
        $this->informarDesvio($jugador3, $num3, $numSecreto);
        $this->informarDesvio($jugador4, $num4, $numSecreto);
        $this->informarDesvio($jugador5, $num5, $numSecreto);
        $this->informarDesvio($jugador6, $num6, $numSecreto);
     }
      $this->rondas++;
    }
    return $this->ganador;
  }
  protected function hayGanador($numSecreto, $num1, $num2, $num3, $num4, $num5, $num6)
  {
    if ($num1 == $numSecreto || $num2 == $numSecreto || $num3 == $numSecreto || $num4 == $numSecreto || $num5 == $numSecreto || $num6 == $numSecreto ) 
	{
      /*if ($num1 == $num2) {
        $this->ganador = 'Ambos jugadores empataron.';
      }*/
      if ($num1 == $numSecreto)
	  {
        $this->ganador = 'Ganó el jugador 1.';
      }
      if($num2 == $numSecreto)
	  {
        $this->ganador = 'Ganó el jugador 2.';
      }
      if($num3 == $numSecreto)
	  {
        $this->ganador = 'Ganó el jugador 3.';
      }
      if($num4 == $numSecreto)
	  {
        $this->ganador = 'Ganó el jugador 4.';
      }
     if($num5 == $numSecreto)
	 {
        $this->ganador = 'Ganó el jugador 5.';
      }
     if($num6 == $numSecreto)
	 {
        $this->ganador = 'Ganó el jugador 6.';
      }
      return true; // Alguno de los jugadores acertó, devolvemos true.
    }
    return false;  // Ningún jugador acertó, devolvemos false.
  }
 protected function informarDesvio(Adivinador $jugador, $numero, $numeroSecreto)
 {
if ($numero > $numeroSecreto) 
{
    $jugador->elNumeroEraMayor();
}
else
{
    $jugador->elNumeroEraMenor();
    }
}
}

$juego = new Juego;
$gano1 = $gano2 = $gano3 = $gano4 = $gano5= $gano6 = 0;
$jugador1 = new Principiante;
$jugador2 = new Principiante;
$jugador3 = new Principiante;
$jugador4 = new Principiante;
$jugador5 = new Principiante;
$jugador6 = new Principiante;
for ($i = 1; $i < 10; $i++) 
{
$resultadoJuego = $juego->jugar($jugador1, $jugador2,$jugador3,$jugador4,$jugador5,$jugador6);
if ($resultadoJuego == "Ganó el jugador 1")
{
$gano1++;
}
if ($resultadoJuego == "Ganó el jugador 2")
{
$gano2++;
}
 if ($resultadoJuego == "Ganó el jugador 3") 
 {
$gano3++;
}
if ($resultadoJuego == "Ganó el jugador 4") 
{
$gano4++;
}
 if ($resultadoJuego == "Ganó el jugador 5")
 {
$gano5++;
}
if ($resultadoJuego == "Ganó el jugador 6") 
{
$gano6++;
}
echo $resultadoJuego;
}
/*if ($gano1 == $gano2) {
echo 'Hubo un empate en el torneo';
} way to many cases to do caso empate*/
if ($gano1 > $gano2 && $gano1 > $gano3 && $gano1 > $gano4 && $gano1 > $gano5 && $gano1 > $gano6) 
{
echo 'Gano el torneo el jugador 1';
}
if($gano2 > $gano1 && $gano2 > $gano3 && $gano2 > $gano4 && $gano2 > $gano5 && $gano2 > $gano6)
{
echo 'Gano el torneo el jugador 2';
}
if($gano3 > $gano1 && $gano3 > $gano2 && $gano3 > $gano4 && $gano3 > $gano5 && $gano3 > $gano6)
{
echo 'Gano el torneo el jugador 3';
}
if($gano4 > $gano1 && $gano4 > $gano2 && $gano4 > $gano3 && $gano4 > $gano5 && $gano4 > $gano6)
{
echo 'Gano el torneo el jugador 4';
}
if($gano5 > $gano1 && $gano5 > $gano2 && $gano5 > $gano3 && $gano5 > $gano4 && $gano5 > $gano6)
{
echo 'Gano el torneo el jugador 5';
}
if($gano6 > $gano1 && $gano6 > $gano2 && $gano6 > $gano3 && $gano6 > $gano4 && $gano6 > $gano5)
{
echo 'Gano el torneo el jugador 6';
}
?>
