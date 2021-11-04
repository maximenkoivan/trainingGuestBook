<?php

namespace App\services;

use App\exceptions\PaginationException;
use App\exceptions\PostRequestException;
use App\models\Post;
use Respect\Validation\Validator as v;

/**
 * Validation class
 * - validatePagination     -Validation of input data for paginated output.
 * - postRequestValidate    -Validation of post-request data.
 */
class Validator
{
    /**
     * @var v
     */
    private v $v;
    /**
     * @var int
     */
    private int $countAllPost;

    public function __construct()
    {
        $this->countAllPost = Post::countAllPosts();
        $this->v = new v();
    }

    /**
     * Validation of input data for paginated output.
     * @param mixed $num
     * @throws PaginationException
     */
    public function validatePagination(mixed $num): void
    {
            if (!$this->v::notEmpty()->positive()->number()->max($this->countAllPost)->validate($num)) {
                throw new PaginationException("The number must be an integer, a positive number and cannot exceed {$this->countAllPost}.");
            }

    }

    /**
     * Validation of post-request data.
     * @param array $data
     * @throws PostRequestException
     */
    public function postRequestValidate(array $data): void
    {

        if (!$this->v::noWhitespace()->stringType()->notEmpty()->length(5, 30)->validate($data['username'])) {
            throw new PostRequestException('The "username" field should be from 5 to 30 characters long and should not consist of spaces.');
        }

        if (!$this->v::email()->validate($data['email'])) {
            throw new PostRequestException('The "Email" field cannot be empty and must contain email.');
        }

        if (!$this->v::noWhitespace()->notEmpty()->length(1, 1000)->validate($data['post'])) {
            throw new PostRequestException('The "Message" field cannot be empty and must not exceed 1000 characters.');
        }

        if(!$this->v::dateTime()->validate($data['date_time'])) {
            throw new PostRequestException('Incorrect data has been entered in the "Date and Time" field.');
        }
    }
}


