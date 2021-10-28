<?php

namespace App\controllers;

use App\services\QueryBuilder;
use JasonGrimes\Paginator;
use League\Plates\Engine;

class HomeController
{
    private QueryBuilder $db;
    private Engine $templates;
    private Paginator $paginator;

    public function __construct(QueryBuilder $queryBuilder, Engine $engine, Paginator $paginator)
    {
        $this->db = $queryBuilder;
        $this->templates = $engine;
        $this->paginator = $paginator;
    }

    public function showGuestBook()
    {
        $showBy = isset($_GET['show_by']) ? abs(floor($_GET['show_by'])) : 10;
        $posts = $this->db->getMultiple(['posts', 'users'],
            ['post', 'date_time', 'username', 'email'],
            ['user_id'],
            $this->paginator->getItemsPerPage(),
            $this->paginator->getCurrentPage()
        );
        $this->paginator->setTotalItems((int) $this->db->countAllPosts('posts')[0]);
        echo $this->templates->render('guestBook', [
            'title' => 'Guest book',
            'posts' => $posts,
            'showBy' => $showBy,
            'paginator' => [
                'paginator' => $this->paginator,
                'showBy' => $this->paginator->getItemsPerPage()
            ]
        ]);
    }

    public function showCreatePost()
    {
        echo $this->templates->render('createPost', ['title' => 'Create post']);
    }

}
