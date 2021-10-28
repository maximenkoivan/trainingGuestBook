<?php

namespace App\models;

use donatj\UserAgent\UserAgentParser;
use App\services\QueryBuilder;
use App\services\Helper;


class Post
{
    private QueryBuilder $db;
    private UserAgentParser $userAgent;

    public function __construct(QueryBuilder $queryBuilder, UserAgentParser $userAgentParser)
    {
        $this->userAgent = $userAgentParser;
        $this->db = $queryBuilder;
    }


    public function handlerPost()
    {
        $data = $_SESSION['data'];
        $data += [
            'user_ip' => ip2long(Helper::getIp()),
            'browser_info' => $this->userAgent->parse()->browser() . ' ' . $this->userAgent->parse()->browserVersion()
        ];
            $post = array_diff_key($data, ['email' => null, 'username' => null]);
            $user = array_diff($data, $post);

            if (!$this->db->checkUniqEmail($user['email'], 'users')) {
                $this->db->insert($user, 'users');
            }
            $user_id = $this->db->getUserId($user['email'], 'user_id', 'users');
            $post += $user_id;
            $this->db->insert($post, 'posts');

            Helper::redirectTo('/guest_book');
            unset($_SESSION['data']);
        }
 }
