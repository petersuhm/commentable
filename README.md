# Commentable

Commentable is a comments model for Laravel 4.

* [Installation](#installation)
* [Basic usage](#basic-usage)
    * [Inheritance](#inheritance)
    * [Interfaces](#interfaces)
    * [Adding comments](#adding-comments)
    * [Retrieving comments](#retrieving-comments)
* [Advanced usage](#advanced-usage)

## Installation

Require `"petersuhm/commentable": "dev-master"` in your `composer.json` file and
run `composer update`:

```
"require-dev": {
    "petersuhm/commentable": "dev-master"
}
```

Add the `CommentableServiceProvider` to the `providers` array in
`app/config/app.php`:

```php
'providers' => array(

    ...

    'Petersuhm\Commentable\CommentableServiceProvider',

);
```

Add a `Comment` alias to the `aliases` array in `app/config/app.php`:

```php
'aliases' => array(

    ...

    'Comment' => 'Petersuhm\Commentable\Comment',

);
```
Finally, you need to run the migration for the `petersuhm_commentable_comments`
table:

```
php artisan migrate --package=petersuhm/commentable
```
## Basic usage

In order to use Commentable's `Comment` model, you have the following
options:

1. Inherit from the `Commentable` and `Authorable` models, provided by
Commentable. This way, you also get acces to the helper methods provided by these
models.

2. Implement the `CommentableInterface` and `AuthorableInterface` interfaces in
your models. This is useful, if you don't inherit from Eloquent in your models
(maybe you use Ardent or something).

3. A mixture of both.

### Inheritance

If you choose to let your models inherit from the `Commentable` and `Authorable`
models, provided by Commentable, you gain access the helper methods, that these
classes offer. This is the easiest way to utilise Comment in your app. You
simply declare your models this way:

```php
use Petersuhm\Commentable\Authorable;
use Petersuhm\Commentable\Commentable;

class User extends Authorable {}

class BlogPost extends Commentable {}
```

### Interfaces

If you don't wish to inherit from the `Commentable` and `Authorable` models, you
can instead implement the `CommentableInterface` and `AuthorableInterface`
interfaces. This way, you will not be able to use the helper methods from
`Commentable` and `Authorable`, unless you add them to your own models. In order
to use Commentable's interfaces, declare your models this way:

```php
use Petersuhm\Commentable\AuthorableInterface;
use Petersuhm\Commentable\CommentableCommentable;

class User extends Eloquent implements AuthorableInterface {
    
    public function comments()
    {
        return $this->morphMany('Comment', 'authorable');
    }
}

class BlogPost extends Eloquent implements CommentableCommentable {
    
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }
}
```

### Adding comments

The `Comment` class has an `add()` function, which returns an unsaved comment
instance. You can add a new comment like this:

```php
$body = 'This is a test comment';
$authorable = User::first();
$commentable = BlogPost::first();

Comment::add($body, $authorable, $commentable)->save();
```

If you use inheritance, you can also use the `addComment` method:

```php
$body = 'This is a test comment';
$authorable = User::first();
$commentable = BlogPost::first();

$commentable->addComment($body, $authorable)->save();

// Or the other way around:

$authorable->addComment($body, $commentable)->save();
```
### Retrieving comments

Thanks to Eloquent, you can retrieve comments just like you would expect:

```php
$authorable = User::first();
$commentable = BlogPost::first();

$authorable->comments()->first()->toArray();
$commentable->comments()->first()->toArray();
```

## Advanced usage

If you wish to overwrite the `Comment` class provided by Commentable, you can do
so by implementing the `CommentInterface`interface in your own `Comment` model.

## Support and suggestions

If you have any problems, or if you have some suggestions,
discover a bug etc., feel free to open an issue!
