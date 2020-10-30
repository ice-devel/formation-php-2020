<?php


namespace App\Tests\Entity;


use App\Entity\Trainee;
use PHPUnit\Framework\TestCase;

class TraineeTest extends TestCase
{
    public function testTraineeProperty() {
        $trainee = new Trainee();
        $trainee->setName("Fab");

        $this->assertEquals("Fab", $trainee->getName());
    }
}