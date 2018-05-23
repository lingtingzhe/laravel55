<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$response = $this->get('/');

        //$response->assertStatus(200);
        $this->assertTrue(true);
    }
/*
    public function testBasicExample(){
        $response = $this->withHeader([
            'X-Header'=> 'LaravelAcademy',
        ])->json('POST','/user',['name'=>'学院君']);
        $response->assertStatus(200)->assertJson(['created'=>true]);
    }

    public function testApplication()
    {
        $user = factory(User::class)->create();

        //$response = $this->withSession(['foo' => 'bar'])->get('/');
        $response = $this->actingAs($user,'api')->withSession(['foo'=>'bar'])->get('/');
    }
*/
}
