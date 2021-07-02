<?php

require 'vendor/autoload.php';

use Src\Config\Database;
use Src\Model\Post;

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

$dbConnection = (new Database())->getConnection();

$post = new Post($dbConnection);
