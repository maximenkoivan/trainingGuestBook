<?php

namespace App\controllers;

use App\exceptions\PaginationException;
use App\exceptions\PostRequestException;
use App\models\Post;
use App\models\User;
use App\services\Session;
use JasonGrimes\Paginator;
use League\Plates\Engine;
use App\services\Validator;
use Tamtamchik\SimpleFlash\Flash;

/**
 * The class of the main controller.
 *
 * - index()            -Validates get-requests and shows the main page (paginated output).
 * - showCreatePost()   -Shows the "Create Post" page.
 * - handlerPost()      -Processes the post-request, validates it and writes it to the database.
 */
class HomeController
{
    private const DEFAULT_SHOW_BY = 10;
    private const DEFAULT_CURRENT_PAGE = 1;
    private mixed $countAllPosts;
    private Engine $templates;
    private Validator $validator;

    public function __construct()
    {
        $this->templates = new Engine('../app/views');
        $this->validator = new Validator();
        $this->countAllPosts = Post::countAllPosts();
    }


    /**
     *Validates get-requests and shows the main page (paginated output).
     */
    public function index(): void
    {
        if (isset($_GET['showBy'])) {
            try {
                $this->validator->validatePagination($_GET['showBy']);
            } catch (PaginationException $paginationException) {
                Flash::error($paginationException->getMessage());
                header('Location: /');
                exit;
            }
        }
        if (isset($_GET['page'])) {
            try {
                $this->validator->validatePagination($_GET['page']);
            } catch (PaginationException $paginationException) {
                Flash::error($paginationException->getMessage());
                header('Location: /');
                exit;
            }
        }

        $paginator = new Paginator(
            $this->countAllPosts,
            $_GET['showBy'] ?? self::DEFAULT_SHOW_BY,
            $_GET['page'] ?? self::DEFAULT_CURRENT_PAGE,
            isset($_GET['showBy']) ? "?showBy={$_GET['showBy']}&page=(:num)" : '?page=(:num)'
        );

        $limit = $paginator->getItemsPerPage();

        $offset = $paginator->getCurrentPage() > 1 ? (($paginator->getCurrentPage() - 1) * $limit) : 0;

        $posts = Post::getMultiplePosts($limit, $offset);


        echo $this->templates->render('guestBook', [
            'title' => 'Guest book',
            'posts' => $posts,
            'paginator' => [
                'paginator' => $paginator,
                'showBy' => $limit
            ]
        ]);
    }

    /**
     *Shows the "Create Post" page.
     * @return void
     */
    public function showCreatePost(): void
    {
        echo $this->templates->render('createPost', ['title' => 'Create post']);
    }

    /**
     *Processes the post-request, validates it and writes it to the database.
     * @return void
     */
    public function handlerPost(): void
    {
        $data = $_POST;
            try {
                $this->validator->postRequestValidate($data);
            } catch (PostRequestException $postRequestException) {
                Flash::error($postRequestException->getMessage());
                Session::getInstance()->set('data', $data);
                header('Location: /create_post');
                exit;
            }


        $data += [
            'user_ip' => User::getUserIp(),
            'browser_info' => User::getBrowserInfo()
        ];

        $data['date_time'] = strtotime($data['date_time']);

        $post = array_diff_key($data, ['email' => null, 'username' => null]);
        $user = array_diff($data, $post);

        if (!User::checkUniqEmail(['email' => $user['email']])) {
            User::insertUser($user);
        } else {
        $user_id = User::getUserId(['email' => $user['email']]);
        User::updateUser(['username' => $user['username'], 'user_id' => $user_id['user_id']]);
        }

        $user_id = User::getUserId(['email' => $user['email']]);
        $post += $user_id;
        Post::insertPost($post);

        header('Location: /');
    }
}
