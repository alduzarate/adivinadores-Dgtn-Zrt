<?php

namespace adivinador;
use PHPUnit\Framework\TestCase;

class adivinadorTest extends TestCase {
  public function testNro() {
    $jugador1 = new Principiante();
    $this->assertGreaterThan($jugador1->sugerirNumeroSecreto(), 0) && $this->assertLessThan($jugador1->sugerirNumeroSecreto(), 1000);

  }
}
?>
