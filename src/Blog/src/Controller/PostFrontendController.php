<?php

namespace Apidemia\Blog\Controller;

use Apidemia\Blog\Entity\PostEntity;
use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Service\PostServiceInterface;
use Dot\Controller\AbstractActionController;
use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Stratigility\MiddlewareInterface;
use Dot\Controller\Plugin\Forms;
use Apidemia\Blog\Messages;
use Dot\Controller\Plugin\FlashMessenger\FlashMessengerPlugin;

/**
 * Class PostFrontendController
 * @package Apidemia\Blog\Controller
 * @method FlashMessengerPlugin messenger()
 */
class PostFrontendController extends AbstractActionController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction(): ResponseInterface
    {

        $data['post'] = $this->postService->getPosts();
//        var_dump($data);
        return new HtmlResponse($this->template('blog::home', $data));
    }

    public function viewAction(): ResponseInterface
    {
        $data = [];
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data['post'] = $this->postService->getPosts($data['slug']);
        if (empty($data['post'])) {
//            var_dump($this->url('blog', ['action' => 'index', 'slug' => null])); exit;
            return new RedirectResponse($this->url('blog', ['action' => 'index', 'slug' => null]));
        }
//        var_dump($data['post']); exit;

        return new HtmlResponse($this->template('blog::view', $data));
    }

    public function createAction(): ResponseInterface
    {
//        $test = $this->getRequest()->getUri()->getPath();//////
//        var_dump($this->url('blog', ['action' => 'index'])); exit;
        //set path to re redirect
        $url = 'http://' .$_SERVER['HTTP_HOST'] . '/blog';
        $form = $this->forms('ViewForm');
        $request = $this->getRequest();

        $data = [];
        $userId = $this->authentication()->getIdentity()->getId();

        //get data from Post
//        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
//            $data = $this->getRequest()->getParsedBody();
//
//            $form->setData($data);
//            if ($form->isValid()) {
//                $message = $form->getData();
//                var_dump($message); exit;
//            }
//        }

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
                    $this->messenger()->addError('Slug exist');
                    return new RedirectResponse($this->url('blog', ['action' => 'create', 'slug' => null]));
                }
                $storage->setSlug($createPost['slug']);
            }
            $data['post'] = $this->postService->createPost($storage);
            $this->messenger()->addSuccess('Post created');
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
            $this->messenger()->addSuccess('Post updated');
            return new RedirectResponse($this->url('blog', ['action' => 'index', 'slug' => null]));
        }
        return new HtmlResponse($this->template('blog::edit', $data));
    }

    public function deleteAction(): ResponseInterface
    {
        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';

        $data = $this->postService->deletePost($data['slug']);
        if ($data) {
            $this->messenger()->addSuccess('Post deleted');
            return new RedirectResponse($this->url('blog', ['action' => 'index', 'slug' => null]));
        }
        exit('Post was not deleted');
    }
}
