<?php
namespace Application\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * Application\Models\Blog
 */
class Blog extends Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $post;

    /**
     *
     * @var bool
     */
    public $is_published;

    /**
     *
     * @var date
     */
    public $created_at;

    /**
     *
     * @var date
     */
    public $modified_at;

    /**
     *
     * @var date
     */
    public $published_at;

    /**
     *
     * @var string
     */
    public $author_id;


    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('slug', new Uniqueness([
            "message" => "The slug is already exists"
        ]));

        return $this->validate($validator);
    }

    public function initialize()
    {
        $this->belongsTo('author_id', __NAMESPACE__ . '\Author', 'id'
            , ['alias' => 'author']
        );
    }
}
