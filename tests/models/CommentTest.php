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
}