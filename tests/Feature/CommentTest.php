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

    public function test_can_view_all_comments()
    {
        $parentComment = factory(Comment::class)->create();
        factory(Comment::class, 10)->create(['parent_id' => $parentComment->id]);
        $response = $this->getJson(route('comment.index'));

        $response->assertJsonStructure(['data' => [['id', 'user', 'parent_id']]]);
    }
}
