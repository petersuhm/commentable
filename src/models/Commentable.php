<?php namespace Petersuhm\Commentable;

use Illuminate\Database\Eloquent\Model;

class Commentable extends Model implements CommentableInterface {

    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    public function addComment($body, $authorable)
    {
        return Comment::add($body, $authorable, $this);
    }
}