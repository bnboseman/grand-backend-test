<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTests extends TestCase
{
    /**
     * Testing route median
     *
     * @return void
     */
    public function testMedian()
    {
        $response = $this->call('GET', '/median');
        $this->assertEquals($response->status(), 200);

        $content = $response->getOriginalContent();
        $numbers = $content->getData()['numbers'];
        $this->assertContainsOnly('int', $numbers);

        $this->assertGreaterThanOrEqual(3, count($numbers));
        $this->assertLessThanOrEqual(10, count($numbers));
    }

    /**
     * Testing route average
     *
     * @return void
     */
    public function testAverage()
    {
        $response = $this->call('GET', '/average');
        $this->assertEquals($response->status(), 200);

        $content = $response->getOriginalContent();
        $numbers = $content->getData()['numbers'];
        $this->assertContainsOnly('int', $numbers);
        $this->assertGreaterThanOrEqual(3, count($numbers));
        $this->assertLessThanOrEqual(10, count($numbers));
    }

    /**
     * Testing failed route magicalHeader
     *
     * @return void
     */
    public function testFailedMagicalHeader()
    {
        $response = $this->call('GET', '/checkMagicalHeader');
        $this->assertEquals($response->status(), 418);
    }

    /**
     * Testing successful route magicalHeader
     *
     * @return void
     */
    public function testSuccessfulMagicalHeader()
    {
        $server = array("HTTP_magical-header"=>"42"); 
        $response = $this->call('GET', '/checkMagicalHeader', [],[],[], $server);
        $this->assertEquals($response->status(), 200);
    }
}
