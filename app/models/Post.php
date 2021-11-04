<?php

namespace App\models;

use App\services\Database;

/**
 * Post model class.
 *
 * - getMultiplePosts()     -Gets an array of all posts (paginated output).
 * - countAllPosts()        -Returns the total number of posts in the database.
 * - insertPost()           -Writes the post to the database.
 */
class Post
{


    /**
     * Gets an array of all posts (paginated output).
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getMultiplePosts(int $limit, int $offset): array
    {
       return Database::getInstance()
           ->query("SELECT post, date_time, username, email 
                    FROM posts INNER JOIN users ON posts.user_id = users.user_id
                    ORDER BY post_id DESC LIMIT {$limit} OFFSET {$offset}")
           ->getResult();
    }

    /**
     * Returns the total number of posts in the database.
     * @return int
     */
    public static function countAllPosts(): int
    {
        return (int) Database::getInstance()->query("SELECT count(*) FROM posts")->getResult()[0]['count(*)'];
    }

    /**
     * Writes the post to the database.
     * @param array $post
     */
    public static function insertPost(array $post): void
    {
        $columns = implode(', ', array_keys($post));
        $value = ':' . implode(', :', array_keys($post));
        Database::getInstance()->query("INSERT INTO posts ({$columns}) VALUE ({$value})", $post);
    }
 }
