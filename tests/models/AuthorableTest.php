<?php

use Mockery as m;

class AuthorableTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testComments()
    {
        m::mock('Illuminate\Database\Eloquent\Model');
        $authorable = m::mock('Petersuhm\Commentable\Authorable[morphMany]');
        $authorable->shouldReceive('morphMany')->with('Comment', 'authorable')->once()->andReturn('foo');

        $this->assertEquals('foo', $authorable->comments());
    }

    public function testAddComment()
    {
        $body = 'Testkommentar';
        $authorable = new Petersuhm\Commentable\Authorable;
        $commentable = new Petersuhm\Commentable\Commentable;

        $authorable->id = 10;
        $commentable->id = 20;

        $comment = $authorable->addComment($body, $commentable);

        $this->assertEquals('Testkommentar', $comment->body);
        $this->assertEquals(10, $comment->authorable_id);
        $this->assertEquals('Petersuhm\Commentable\Authorable', $comment->authorable_type);
        $this->assertEquals(20, $comment->commentable_id);
        $this->assertEquals('Petersuhm\Commentable\Commentable', $comment->commentable_type);
    }
}