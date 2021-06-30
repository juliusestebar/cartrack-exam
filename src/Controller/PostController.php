<?php

namespace Src\Controller;

use Src\Model\Post;
use Src\Traits\Pagination;
use Src\Controller\Controller;

class PostController extends Controller
{
    use Pagination;

    private $db;
    private $requestMethod;
    private $post_id;

    private $post;

    public function __construct($db, $requestMethod, $post_id)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->post_id = $post_id;

        $this->post = new Post($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->post_id) {
                    $response = $this->getSinglePost($this->post_id);
                } else {
                    $response = $this->getAllPosts();
                }
                break;
            case 'POST':
                if ($this->post_id) {
                    $response = $this->searchPost();
                }else{
                    $response = $this->createPost();
                }
                break;
            case 'PUT':
                $response = $this->updatePost($this->post_id);
                break;
            case 'DELETE':
                $response = $this->deletePost($this->post_id);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllPosts()
    {
        $result = $this->post->get_all();
        $result['pagination'] = $this->pagination($result);
        return $this->http_response($result);
        // $response['status_code_header'] = 'HTTP/1.1 200 OK';
        // $response['body'] = json_encode($result);
        // return $response;
    }

    private function getSinglePost($id)
    {
        $result = $this->post->single_read($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createPost()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validatePost($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->post->create($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($input);
        return $response;
    }

    private function updatePost($id)
    {
        $result = $this->post->single_read($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validatePost($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->post->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($input);
        return $response;
    }

    private function deletePost($id)
    {
        $result = $this->post->single_read($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $this->post->delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function validatePost($input)
    {
        if (!isset($input['title'])) {
            return false;
        }
        if (!isset($input['body'])) {
            return false;
        }
        if (!isset($input['author'])) {
            return false;
        }
        if (!isset($input['category_id'])) {
            return false;
        }       
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

    private function searchPost()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $result = $this->post->search($input);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}
