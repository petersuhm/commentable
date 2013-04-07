<?php namespace Petersuhm\Commentable;

use Illuminate\Database\Eloquent\Model;

class Authorable extends Model {

    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    public function addComment($body, $commentable)
    {
        return Comment::add($body, $this, $commentable);
    }
}