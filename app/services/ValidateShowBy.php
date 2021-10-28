<?php

namespace App\services;

use Respect\Validation\Validator;
use Tamtamchik\SimpleFlash\Flash;

class ValidateShowBy
{


    private Validator $v;

    public function __construct(Validator $validator)
    {
        $this->v = $validator;
    }

    public function validate() {
        $showBy = $_GET['show_by'];

        if (!$this->v::notEmpty()->number()->max(100)->validate($showBy)) {
            Flash::message('Enter an integer no more than 100.');
            Helper::redirectTo("/guest_book");
            exit;
        };
        $showBy = abs(floor($showBy));
        Helper::redirectTo("/guest_book?show_by={$showBy}");
    }

    public function validateRequest()
    {
        $data = $_POST;

        if (!$this->v::noWhitespace()->stringType()->notEmpty()->length(5, 30)->validate($data['username'])) {
            Flash::message('The "username" field should be from 5 to 30 characters long and should not consist of spaces.');
        }

        if (!$this->v::email()->validate($data['email'])) {
            Flash::message('The "Email" field cannot be empty and must contain email.');
        }

        if (!$this->v::noWhitespace()->notEmpty()->length(1, 1000)->validate($data['post'])) {
            Flash::message('The "Message" field cannot be empty and must not exceed 1000 characters..');
        }

        if(!$this->v::dateTime()->validate($data['date_time'])) {
            Flash::message('Incorrect data has been entered in the "Date and Time" field.');
        }

        if (Flash::hasMessages()) {
            Helper::redirectTo('/guest_book/create_post', $data);
        } else {
            Helper::redirectTo('/handler_post', $data);
        }
    }
}