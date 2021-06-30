<?php
require 'bootstrap.php';

$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS categories (
        id serial PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );

    INSERT INTO categories (id, name) VALUES
        (1, 'Technology'),
        (2, 'Gaming'),
        (3, 'Auto'),
        (4, 'Entertainment'),
        (5, 'Books');

    CREATE TABLE IF NOT EXISTS posts (
        id serial PRIMARY KEY,
        category_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        body text NOT NULL,
        author VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );        

    INSERT INTO posts ( category_id, title, body, author) VALUES
        ( 1, 'Technology Post One', 'Lorem ipsum dolor.','Sam Smith'),
        ( 2, 'Gaming Post One', 'Adipiscing elit. Etiam pulvinar.','Kevin Williams'),
        ( 1, 'Technology Post Two', 'Ut interdum est nec lorem mattis interdum.','Sam Smith'),
        ( 4, 'Entertainment Post One', 'Cras augue est, interdum eu consectetur et.','Mary Jackson'),
        ( 4, 'Entertainment Post Two', 'Faucibus vel turpis.','Mary Jackson'),
        ( 1, 'Technology Post Three', 'Etiam pulvinar, enim quis elementum iaculis.','Sam Smith');


EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}
