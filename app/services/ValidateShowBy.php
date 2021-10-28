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
}