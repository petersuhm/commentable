<?php namespace Petersuhm\Commentable;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent {

    protected $fillable = array('body');

    public function commentable()
    {
        return $this->morphTo();
    }
}