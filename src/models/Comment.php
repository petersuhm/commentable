<?php namespace Petersuhm\Commentable;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements CommentInterface {

    protected $fillable = array('body');

    public function commentable()
    {
        return $this->morphTo();
    }

    public function authorable()
    {
        return $this->morphTo();
    }

    public static function add($body, $authorable, $commentable)
    {
        $comment = new Comment;

        $comment->body = $body;
        $comment->authorable_id = $authorable->id;
        $comment->authorable_type = get_class($authorable);
        $comment->commentable_id = $commentable->id;
        $comment->commentable_type = get_class($commentable);

        return $comment;
    }
}