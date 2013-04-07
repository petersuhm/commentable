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
}