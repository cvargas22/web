<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VerInstitucionesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSanAntonio()
    {
        $this->visit('/')
             ->see('Comedor San Antonio');
    }
}
