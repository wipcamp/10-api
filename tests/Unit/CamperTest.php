<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CamperTest extends TestCase
{
    use WithoutMiddleware;

    public function testUpdateFlavorsWithNoDataShouldReturnInvalidData()
    {
        // disable middleware
        $this->withoutMiddleware();

        $url = '/api/v1/campers/100066/flavors';
        $response = $this->put($url);
        
        $response->assertStatus(200)
        ->assertJson([
            'error' => 'Invalid Data.'
        ]);
    }
    
    public function testUpdateFlavorWithUserIdShouldWorkCorrectly()
    {
        $url = '/api/v1/campers/100066/flavors';
        $response = $this->json('PUT', $url, ['sectionId' => 3]);

        $response->assertStatus(200)
        ->assertJson([
            'status' => 200,
            'data' => 1
        ]);
    }
    
    public function testUpdateFlavorAgainWithUserIdShouldWorkCorrectly()
    {
        $url = '/api/v1/campers/100066/flavors';
        $response = $this->json('PUT', $url, ['sectionId' => 10]);

        $response->assertStatus(200)
        ->assertJson([
            'status' => 200,
            'data' => 1
        ]);
    }

    public function testUpdateFlavorWithNoSectionShouldReturnError()
    {
        $url = '/api/v1/campers/100066/flavors';
        $response = $this->json('PUT', $url, ['sectionId' => 11]);
        $response->assertStatus(200)
        ->assertJson([
            'status' => 200,
            'data' => [
                'errorInfo' => [
                    "23000"
                ]
            ]
        ]);
    }
    
    public function testUpdateFlavorWithNoSectionAgainShouldReturnError()
    {
        $url = '/api/v1/campers/100066/flavors';
        $response = $this->json('PUT', $url, ['sectionId' => -1]);
        $response->assertStatus(200)
        ->assertJson([
            'status' => 200,
            'data' => [
                'errorInfo' => [
                    "22003"
                ]
            ]
        ]);
    }

}
