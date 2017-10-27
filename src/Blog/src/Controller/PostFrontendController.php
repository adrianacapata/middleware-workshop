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
use Dot\Controller\Plugin\Forms\FormsPlugin;
use Zend\Form\Form;
use Apidemia\Blog\Messages;
use Dot\Controller\Plugin\FlashMessenger\FlashMessengerPlugin;

/**
 * Class PostFrontendController
 * @package Apidemia\Blog\Controller
 * @method FormsPlugin|Form forms(string $name = null)
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


    public function createFormAction(): ResponseInterface
    {
        $form = $this->forms('CreateForm');
        $request = $this->getRequest();

        $userId = $this->authentication()->getIdentity()->getId();


        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $data = $this->getRequest()->getParsedBody();
            $form->setData($data);

            if ($form->isValid()) {
                $message = $form->getData()['CreateForm'];
                $post = new PostEntity();

                $post->setContent($message['content']);
                $post->setTitle($message['title']);
                $post->setSlug($message['slug']);
                $post->setUserId($userId);

                $result = $this->postService->createPost($post);
                if ($result) {
                    $this->messenger()->addSuccess('Post created');
                    return new RedirectResponse('\blog');
                } else {
                    $this->messenger()->addError('Error saving post. Please try again');
                    return new RedirectResponse($request->getUri(), 303);
                }
            } else {
                $this->messenger()->addError($this->forms()->getMessages($form));
                $this->forms()->saveState($form);
                return new RedirectResponse($request->getUri(), 303);
            }
        }
        return new HtmlResponse($this->template('blog::create-form', [
                'form' => $form
            ]));
    }

    public function editFormAction(): ResponseInterface
    {

        $slug = $this->getRequest()->getAttributes();
        $data['slug'] = $slug['slug'] ?? 'N\A';
        $data['post'] = $this->postService->getPosts($data['slug'])[0];
//        echo '<pre>';
//var_dump($data['post']); exit;
        $form = $this->forms('EditForm');
        $request = $this->getRequest();
        $userId = $this->authentication()->getIdentity()->getId();

        if ($data['post']->getUserId() != $userId) {
            $this->messenger()->addError('You don`t have permisions');
            return new RedirectResponse('/blog');
        }

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $edit = $request->getParsedBody();
            $form->setData($edit);

            if ($form->isValid()) {
                $message = $form->getData()['EditForm'];
                $post = new PostEntity();

                $post->setContent($message['content']);
                $post->setTitle($message['title']);
                $post->setSlug($message['slug']);
                $post->setUserId($userId);
                $post->setId($data['post']->getId());


                $result = $this->postService->updatePost($data['slug'], $post);
                if ($result) {
                    $this->messenger()->addSuccess('Post updated');
                    return new RedirectResponse($this->url('blog', ['action' => 'index', 'slug' => null]));
                } else {
                    $this->messenger()->addError('Error saving post. Please try again');
                    return new RedirectResponse($request->getUri(), 303);
                }
            } else {
                $this->messenger()->addError($this->forms()->getMessages($form));
                $this->forms()->saveState($form);
                return new RedirectResponse($request->getUri(), 303);
            }
        }

        return new HtmlResponse($this->template('blog::edit-form', [
            'form' => $form
        ]));
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
