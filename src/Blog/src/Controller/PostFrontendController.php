<?php

namespace Apidemia\Blog\Controller;

use Apidemia\Blog\Entity\PostEntity;
use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Service\PostServiceInterface;
use Dot\Controller\AbstractActionController;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Stratigility\MiddlewareInterface;

class PostFrontendController extends AbstractActionController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction(): ResponseInterface
    {
        $form = $this->forms('viewForm');

        $data['post'] = $this->postService->getPosts();
//        var_dump($data);
        return new HtmlResponse($this->template('blog::home', ['form' => $form]));
    }

    public function viewAction(): ResponseInterface
    {
        $data = [];
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data['post'] = $this->postService->getPosts($data['slug']);

        return new HtmlResponse($this->template('blog::view', $data));
    }

    public function createAction(): ResponseInterface
    {
//        $test = $this->getRequest()->getUri()->getPath();//////
//        var_dump($this->url('blog', ['action' => 'index'])); exit;
        //set path to re redirect
        $url = 'http://' .$_SERVER['HTTP_HOST'] . '/blog';
        $data = [];
        $userId = $this->authentication()->getIdentity()->getId();
        //get data from Post
        $createPost = $this->getRequest()->getParsedBody();
        //get data from db
        $dbPost = $this->postService->getPosts();

        if (!empty($createPost)) {
//            var_dump($dbPost); exit;
            $storage = new PostEntity();
            $storage->setTitle($createPost['title']);
            $storage->setContent($createPost['content']);
            $storage->setUserId($userId);

            foreach ($dbPost as $value) {
                if ($createPost['slug'] === $value->getSlug()) {
//                    exit ('slug already exists');
                    return new RedirectResponse($this->url('blog', ['action' => '']));
                }
                $storage->setSlug($createPost['slug']);
            }
            $data['post'] = $this->postService->createPost($storage);
            return new RedirectResponse($url);
        }
        return new HtmlResponse($this->template('blog::create', $data));
    }

    public function editAction(): ResponseInterface
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data['post'] = $this->postService->getPosts($data['slug'])[0];

        $editPost = $this->getRequest()->getParsedBody();
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

    public function deleteAction(): ResponseInterface
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data = $this->postService->deletePost($data['slug']);
        if ($data) {
            exit('Succes -> post Deleted');
        }
        exit('Post was not deleted');
    }
}
