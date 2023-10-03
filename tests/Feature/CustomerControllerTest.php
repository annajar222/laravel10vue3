<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testListsCustomers(): void
    {
        $this->seed();
        $response = $this->get('/api/customers');
        $response->assertOK();
        $this->assertCount(15,$response->json('data'));
        $this->assertNotNull($response->json('data')[0]['tel']);
    }

    public function testCreateCusotomer()
    {
        $response = $this->post('api/customers', [
            'name' => 'first client',
            'tel' => '06941720240',
            'is_favourite' => true
        ]);

        $response->assertOk();
    }

    public function testCustumerValidation()
    {
        $response = $this->post('api/customers', [
            'name' => '',
            'tel' => '',
            'is_favourite' => ''
        ]);

        $response->assertSessionHasErrors(['name','tel','is_favourite']);
    }
}
