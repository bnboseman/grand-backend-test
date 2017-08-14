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
                $this->assertGreaterThan(0, $number);
                $this->assertLessThan(100, $number);
            }
        }
    }

    public function testNumberAverage()
    {
        $this->functionTest([1,2,3,4,5], 3, 'average');
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Array must contain numbers
     */
    public function testLetterAverage()
    {
        $this->functionTest(['a','b','c'], null, 'average');
    }

    public function testNumberMedian()
    {
        // Make it dry
        $this->functionTest([2,1,3,5,4], 3, 'median');
        $this->functionTest([2,1,3,4], 2.5, 'median');
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Array must contain numbers
     */
    public function testLetterMedian()
    {
        $this->functionTest(['a','b','c'], null, 'median');
    }

    private function functionTest(array $array, $expected, $testFunction)
    {
        if (!in_array($testFunction, ['average', 'median'])) {
            return;
        }
        $median = Numbers::$testFunction($array);
        $this->assertEquals($expected, $median);
    }
}
