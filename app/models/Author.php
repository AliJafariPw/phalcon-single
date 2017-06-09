<?php
namespace Application\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * Application\Models\Author
 */
class Author extends Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var bool
     */
    public $username;

    /**
     *
     * @var string
     */
    public $password;

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
        $this->hasMany('id', __NAMESPACE__ . '\Blog', 'author_id', [
            'alias' => 'blogs',
            'foreignKey' => [
                'message' => 'User cannot be deleted because author has blog in the system'
            ]
        ]);
    }
}
