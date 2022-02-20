<?php

namespace Tests\Feature\controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->withoutMiddleware();

        $response = $this->call('GET', 'posts');
        // $response->assertViewHas('posts.index');
        $response->assertSuccessful();
    }
}
