<?php

use Mockery as m;
use Petersuhm\Commentable\Comment;

class CommentTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testCommentable()
    {
        m::mock('Illuminate\Database\Eloquent\Model');
        $comment = m::mock('Petersuhm\Commentable\Comment[morphTo]');
        $comment->shouldReceive('morphTo')->once()->andReturn('foo');

        $this->assertEquals('foo', $comment->commentable());
    }

    public function testAuthorable()
    {
        m::mock('Illuminate\Database\Eloquent\Model');
        $comment = m::mock('Petersuhm\Commentable\Comment[morphTo]');
        $comment->shouldReceive('morphTo')->once()->andReturn('foo');

        $this->assertEquals('foo', $comment->authorable());
    }

    public function testStaticAdd()
    {
        $body = 'Testkommentar';
        $authorable = new Petersuhm\Commentable\Authorable;
        $commentable = new Petersuhm\Commentable\Commentable;

        $authorable->id = 10;
        $commentable->id = 20;

        $comment = Comment::add($body, $authorable, $commentable);

        $this->assertEquals('Testkommentar', $comment->body);
        $this->assertEquals(10, $comment->authorable_id);
        $this->assertEquals('Petersuhm\Commentable\Authorable', $comment->authorable_type);
        $this->assertEquals(20, $comment->commentable_id);
        $this->assertEquals('Petersuhm\Commentable\Commentable', $comment->commentable_type);
    }
}