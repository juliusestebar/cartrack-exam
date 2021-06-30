<?php

namespace Src\Model;

class Post
{

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get_all()
    {
        $statement = "
            SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                    FROM posts p
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                    ORDER BY
                    p.created_at DESC
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function single_read($id)
    {
        $statement = "
            SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM posts p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                WHERE
                    p.id = ?
                LIMIT 0,1;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function create(array $input)
    {
        $statement = "
            INSERT INTO posts SET title = :title, body = :body, author = :author, category_id = :category_id
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'title' => $input['title'],
                'body'  => $input['body'],
                'author' => $input['author'] ?? null,
                'category_id' => $input['category_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, array $input)
    {
        $statement = "
            UPDATE posts
                SET title = :title, body = :body, author = :author, category_id = :category_id
                WHERE id = :id
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'title' => $input['title'],
                'body'  => $input['body'],
                'author' => $input['author'] ?? null,
                'category_id' => $input['category_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM posts WHERE id = :id
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function search(array $input)
    {
        
        $condition = array();
        $where = "WHERE ";
        foreach ($input as $key => $field) {
            $condition[] = $key . ' like "%' . $field . '%"';
        }
        //will add WHERE OR and AND conditions later on
        $where .= implode(" AND ", $condition);
        $statement = "
            SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM posts p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                $where;
        ";


        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
