<?php

namespace Apidemia\Blog\Controller;

use Apidemia\Blog\Entity\PostEntity;
use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Service\PostServiceInterface;
use Dot\Controller\AbstractActionController;
use Dot\Hydrator\ClassMethodsCamelCase;
use Zend\Stdlib\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

class PostFrontendController extends AbstractActionController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction()
    {
        $data['post'] = $this->postService->getPosts();

        return new HtmlResponse($this->template('blog::home', $data));
//        var_dump($data);
//        exit;
    }

    public function viewAction()
    {
        $data = [];
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data = $this->postService->getPosts();

        return new HtmlResponse($this->template('blog::home', $data));
//        var_dump($data);
//        exit;
    }

    public function createAction(): ResponseInterface
    {
        $storage = new PostEntity();
        $storage->setTitle('title4');
        $storage->setSlug('slug4');
        $storage->setContent('content4');
        $storage->setUserId(1);

        $data = $this->postService->createPost($storage);

        exit('createPage');
    }

    public function updateAction(): ResponseInterface
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $storage = new PostEntity();
        $storage->setId(9);
        $storage->setTitle('title');
        $storage->setSlug($data['slug']);
        $storage->setContent('content0');
        $storage->setUserId(1);
//        $storage->setPublishDate(28);

        $data = $this->postService->updatePost($data['slug'], $storage);

        exit('updatePage');
    }

    public function deleteAction(): ResponseInterface
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $storage = new PostEntity();
        $storage->setId(3);
        $storage->setTitle('title3');
        $storage->setSlug($data['slug']);
        $storage->setContent('content3');
        $storage->setUserId(1);
//        $storage->setPublishDate(28);

        $data = $this->postService->deletePost($data['slug']);
        exit('deletePage');
    }
}
