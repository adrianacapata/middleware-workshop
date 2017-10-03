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
    }

    public function viewAction()
    {
        $data = [];
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data['post'] = $this->postService->getPosts($data['slug']);

        return new HtmlResponse($this->template('blog::home', $data));
    }

    public function createAction()
    {
        $storage = new PostEntity();
        $storage->setTitle('title8908');
        $storage->setSlug('slug47');
        $storage->setContent('content4df');
        $storage->setUserId(1);

        $data = $this->postService->createPost($storage);

        exit('createPage');
    }

    public function editAction()
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data['post'] = $this->postService->getPost($data['slug']);
//        echo '<pre>';
//        var_dump($data['post']);
//        echo '<br>';

        $edit = $this->getRequest()->getParsedBody();
        if (!empty($edit)) {
//            var_dump(current($data)); exit;
            $storage = new PostEntity();
            $storage->setTitle($edit['title']);
            $storage->setUserId(1);
            $storage->setContent($edit['content']);
            $storage->setSlug($data['slug']);
            $storage->setId($data['post']->getId());
//            $storage->setId(11);
//            echo '<pre>';
//            var_dump($storage); exit;
            $data['post'] = $this->postService->updatePost($data['slug'], $storage);
        }
//        var_dump($data);exit;
        return new HtmlResponse($this->template('blog::edit', $data));
    }

    public function deleteAction()
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
