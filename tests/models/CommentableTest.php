<?php

use Mockery as m;

class CommentableTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testComments()
    {
        m::mock('Illuminate\Database\Eloquent\Model');
        $commentable = m::mock('Petersuhm\Commentable\Commentable[morphMany]');
        $commentable->shouldReceive('morphMany')->with('Comment', 'commentable')->once()->andReturn('foo');

        $this->assertEquals('foo', $commentable->comments());
    }

    public function testAddComment()
    {
        $body = 'Testkommentar';
        $authorable = new Petersuhm\Commentable\Authorable;
        $commentable = new Petersuhm\Commentable\Commentable;

        $authorable->id = 10;
        $commentable->id = 20;

        $comment = $commentable->addComment($body, $authorable);

        $this->assertEquals('Testkommentar', $comment->body);
        $this->assertEquals(10, $comment->authorable_id);
        $this->assertEquals('Petersuhm\Commentable\Authorable', $comment->authorable_type);
        $this->assertEquals(20, $comment->commentable_id);
        $this->assertEquals('Petersuhm\Commentable\Commentable', $comment->commentable_type);
    }
}