<?php namespace Petersuhm\Commentable;

use Illuminate\Database\Eloquent\Model;

class Authorable extends Model implements AuthorableInterface {

    public function comments()
    {
        return $this->morphMany('Comment', 'authorable');
    }

    public function addComment($body, $commentable)
    {
        return Comment::add($body, $this, $commentable);
    }
}