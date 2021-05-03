<?php

namespace Tests\Feature;

use App\Comment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $parentComment;
    protected $replies;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parentComment = factory(Comment::class)->create();
        factory(Comment::class, 10)->create(['parent_id' => $this->parentComment->id]);
    }

    public function test_can_view_all_comments()
    {
        $response = $this->getJson(route('comment.index'));
        $response->assertJsonStructure(['data' => [['id', 'user', 'parent', 'content']]]);
    }

    public function test_can_post_comment()
    {
        $payload = [
            'content' => $this->faker->paragraph,
            'user' => $this->faker->name,
        ];
        $response = $this->postJson(route('comment.store'), $payload);
        $response->assertJsonStructure(['data' => ['id', 'user', 'parent', 'content']]);
    }

    public function test_can_post_comment_reply()
    {
        $payload = [
            'content' => $this->faker->paragraph,
            'user' => $this->faker->name,
            'parent_id' => $this->parentComment->id,
        ];
        $response = $this->postJson(route('comment.store'), $payload);
        $response->assertJsonStructure(['data' => ['id', 'user', 'parent', 'content']]);
        $response->assertJsonFragment(['id' => $this->parentComment->id]);
    }
}
