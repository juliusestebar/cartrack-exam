<?php

require 'vendor/autoload.php';

use Src\Config\Database;
use Src\Model\Post;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//echo 'DB_DATABASE=' . $_ENV['DB_DATABASE'];

$dbConnection = (new Database())->getConnection();

$post = new Post($dbConnection);

//////---- get all posts -----
// echo "<pre>";
// print_r($post->get_all());
// exit;

//////---- read post id  -----
// echo "<pre>";
// print_r($post->single_read(7));
// exit;

//////---- create post -----
// $result = $post->create([
//     'title' => 'test',
//     'body' => 'author',
//     'author' => 'testman',
//     'category_id' => 3
// ]);

// echo "<pre>";
// print_r($result);
// exit;


//////---- update post using id  -----
// $result = $post->update(7, [
//     'title' => 'title update',
//     'body' => 'body update',
//     'author' => 'author update',
//     'category_id' => 3,
// ]);

// echo "<pre>";
// print_r($result);
// exit;

//////---- delete post using id  -----
// $result = $post->delete(8);
// echo "<pre>";
// print_r($result);
// exit;


//////---- search post ( AND CONDITION ONLY )  -----
// $search = [
//     //'title' => "One",
//     'author' => "Sam",
//     //'body' => "dolor"
// ];
// $result = $post->search($search);
// echo "<pre>";
// print_r($result);
// exit;