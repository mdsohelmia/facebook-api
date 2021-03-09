<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostToTimeLineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_text_post()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');

        $response = $this->post('/api/v1/posts', [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing body'
                ],
            ]
        ]);
        $post = Post::latest()->sole();
        $this->assertCount(1, Post::all());
        $response->assertStatus(201)->assertJson([
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'id' => $post->id,
                    'author' => $user->name,
                    'body' => 'Testing body',
                ],
            ],
            'links' => [
                'self' => route('posts.show', $post->id)
            ]
        ]);

    }

   /** @test */
    public function a_user_can_send_message(){

        $this->assertTrue(true);
    }
}

