<?php

namespace Apidemia\Blog\Controller;

use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Service\PostServiceInterface;
use Dot\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface;

class PostFrontendController extends AbstractActionController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction(): ResponseInterface
    {
        $data = $this->postService->getPosts();

        var_dump($data);
        exit;
    }

    public function createAction(): ResponseInterface
    {
        exit('createPage');
    }

    public function updateAction(): ResponseInterface
    {
        exit('updatePage');
    }

    public function deleteAction(): ResponseInterface
    {
        exit('deletePage');
    }
}
