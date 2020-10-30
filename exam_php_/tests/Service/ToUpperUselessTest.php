<?php

namespace App\Tests\Service;

use App\Service\ToUpperUseless;
use PHPUnit\Framework\TestCase;

class ToUpperUselessTest extends TestCase
{
    public function testToUpperUseless()
    {
        $toUpperUseless = new ToUpperUseless();

        $string = $toUpperUseless->toUpperUseless("fab");
        $this->assertEquals("Hello FAB !", $string);

        $string = $toUpperUseless->toUpperUseless("éric");
        $this->assertEquals("Hello ÉRIC !", $string);
    }

    /**
     * @dataProvider providerErrors
     */
    public function testToUpperUselessError($str1, $str2)
    {
        $toUpperUseless = new ToUpperUseless();

        $string = $toUpperUseless->toUpperUseless($str1);
        $this->assertNotEquals($str2, $string);
    }

    public function providerErrors() {
        return [
            ['coucou', 'Hello COUcou !'],
            ['coucou2', 'Hello COUCou2 !'],
            ['coucou3', 'Hello coucoU3 !']
        ];
    }
}
