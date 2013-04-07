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
        $authorable->shouldReceive('morphMany')->with('Comment', 'commentable')->once()->andReturn('foo');

        $this->assertEquals('foo', $authorable->comments());
    }
}