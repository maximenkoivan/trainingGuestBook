<?php

namespace App\models;

use donatj\UserAgent\UserAgentParser;
use App\services\QueryBuilder;
use Respect\Validation\Validator;
use Tamtamchik\SimpleFlash\Flash;
use App\services\Helper;




class Post
{
    private QueryBuilder $db;
    private UserAgentParser $userAgent;
    private Validator $v;

    public function __construct(QueryBuilder $queryBuilder, UserAgentParser $userAgentParser, Validator $validator)
    {
        $this->v = $validator;
        $this->userAgent = $userAgentParser;
        $this->db = $queryBuilder;
    }

    public function validateRequest()
    {

        if (!$this->v::noWhitespace()->stringType()->notEmpty()->length(5, 30)->validate($_POST['username'])) {
            Flash::message('The "username" field should be from 5 to 30 characters long and should not consist of spaces.');
        }

        if (!$this->v::email()->validate($_POST['email'])) {
            Flash::message('The "Email" field cannot be empty and must contain email.');
        }

        if (!$this->v::noWhitespace()->notEmpty()->length(1, 1000)->validate($_POST['post'])) {
            Flash::message('The "Message" field cannot be empty and must not exceed 1000 characters..');
        }

        if(!$this->v::dateTime()->validate($_POST['date_time'])) {
            Flash::message('Incorrect data has been entered in the "Date and Time" field.');
        }

        if (Flash::hasMessages()) {
            Helper::redirectTo('/guest_book/create_post', $_POST);
        } else {
            $this->handlerPost();
        }
    }

    public function handlerPost()
    {
        $data = $_POST;
        $data += [
            'user_ip' => ip2long(Helper::getIp()),
            'browser_info' => $this->userAgent->parse()->browser() . ' ' . $this->userAgent->parse()->browserVersion()
        ];
            $post = array_diff_key($data, ['email' => null, 'username' => null]);
            $user = array_diff($data, $post);

            if (!$this->db->checkUniqEmail($user['email'], 'users')) {
                $this->db->insert($user, 'users');
            }
            $user_id = $this->db->getUserId($user['email'], 'users');
            $post += $user_id;
            $this->db->insert($post, 'posts');

            Helper::redirectTo('/guest_book');
        }
 }
