<?php

namespace Apidemia\Blog\Controller;

use Apidemia\Blog\Entity\PostEntity;
use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Service\PostServiceInterface;
use Dot\Controller\AbstractActionController;
use Dot\Hydrator\ClassMethodsCamelCase;
use Zend\Stdlib\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

class PostFrontendController extends AbstractActionController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction()
    {
        $data['post'] = $this->postService->getPosts();
//        var_dump($data);

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
        $url = 'http://' .$_SERVER['HTTP_HOST'] . '/blog';
//        var_dump($url); exit;
        $data = [];

        $create = $this->getRequest()->getParsedBody();

        if (!empty($create)) {
            $storage = new PostEntity();
//            $storage->setId(4);
            $storage->setTitle($create['title']);
            $storage->setContent($create['content']);
            $storage->setSlug($create['slug']);
            $storage->setUserId(1);
//            var_dump($storage); exit;
            $data['post'] = $this->postService->createPost($storage);

            return new RedirectResponse($url);
        }
        return new HtmlResponse($this->template('blog::create', $data));
    }

    public function editAction()
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data['post'] = $this->postService->getPosts($data['slug'])[0];

        $edit = $this->getRequest()->getParsedBody();

        if (!empty($edit)) {
            $storage = new PostEntity();
            $storage->setTitle($edit['title']);
            $storage->setUserId($data['post']->getUserId());
            $storage->setContent($edit['content']);
            $storage->setSlug($data['slug']);
            $storage->setId($data['post']->getId());

            $data['post'] = $this->postService->updatePost($data['slug'], $storage);
        }
        return new HtmlResponse($this->template('blog::edit', $data));
    }

    public function deleteAction()
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $storage = new PostEntity();
//        $storage->setId(3);
        $storage->setTitle('title3');
        $storage->setSlug($data['slug']);
        $storage->setContent('content3');
        $storage->setUserId(1);
//        $storage->setPublishDate(28);

        $data = $this->postService->deletePost($data['slug']);
        exit('postDeleted');
    }
}
