<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\InvestForward\Numbers;

class NumberTest extends TestCase
{
    /**
     * Test generating a random array
     * Should generate an array of 3 to 10 values all with numbers between 1 and 99
     *
     * @return void
     */
    public function testGenerateArray()
    {
        for ($i = 0; $i < 20; $i++) {
            $numbers = Numbers::generateArray();
            $this->assertInternalType('array', $numbers);
            $this->assertContainsOnly('int', $numbers);
            $this->assertGreaterThanOrEqual(3, count($numbers));
            $this->assertLessThanOrEqual(10, count($numbers));
            foreach ($numbers as $number) {
                $this->assertGreaterThan(0, count($numbers));
                $this->assertLessThan(100, count($numbers));
            }


        }
    }

    public function testNumberAverage() {
        $numbers = [1,2,3,4,5];
        $average = Numbers::average($numbers);
        $this->assertEquals(3, $average);
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Array must contain numbers
     */
    public function testLetterAverage() {
        $letters = ['a','b','c'];
        $average = Numbers::average($letters);
    }

    public function testNumberMedian() {
        $numbers = [2,1,3,5,4];
        $median = Numbers::median($numbers);
        $this->assertEquals(3, $median);

        $numbers = [2,1,3,4];
        $median = Numbers::median($numbers);
        $this->assertEquals(2.5, $median);
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Array must contain numbers
     */
    public function testLetterMedian() {
        $letters = ['a','b','c'];
        $median = Numbers::median($letters);
    }
}
