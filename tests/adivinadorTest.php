<?php


namespace Ejemplo;

use PHPUnit\Framework\TestCase;

class TrianguloTest extends TestCase {


  public function testArea() {
    $jugador1 = new Principiante;
    $this->assertGreaterThan($jugador1->sugerirNumeroSecreto(), 0)&&$this->assertLessThan($jugador1->sugerirNumeroSecreto(), 1000);

  }

}
