<?php

namespace Tests\Functional;

class APITest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('SlimFramework', (string)$response->getBody());
    }

    /**
     * Test todos API
     */
     public function testGetTodos()
     {
         $response = $this->runApp('GET', '/todo');
 
         $this->assertEquals(200, $response->getStatusCode());
 
         $json = json_decode($response->getBody(), true);
 
         $this->assertGreaterThanOrEqual(1, count($json));
         $this->assertContains(['suscess', 'data'], $json);
         $this->assertGreaterThanOrEqual(1, count($json['data']));
     }

     /**
      * Test category API
      */
     public function testGetCategories()
     {
         $response = $this->runApp('GET', '/category');
 
         $this->assertEquals(200, $response->getStatusCode());
 
         $json = json_decode($response->getBody(), true);
 
         $this->assertGreaterThanOrEqual(1, count($json));
         $this->assertContains(['suscess', 'data'], $json);
     }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}
