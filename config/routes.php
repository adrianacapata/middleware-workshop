<?php

use Dot\Authentication\Web\Action\LoginAction;
use Dot\Authentication\Web\Action\LogoutAction;
use Dot\User\Controller\UserController as UserController;
use Frontend\App\Controller\ContactController;
use Frontend\App\Controller\PageController;
use Frontend\User\Controller\UserController as FrontendUserController;
use Apidemia\Blog\Controller\PostFrontendController;
use Apidemia\Message\Controller\MessageController;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

/** @var \Zend\Expressive\Application $app */

$app->route('/', [\Workshop\Middleware\DbMultilanguageMiddleware::class, PageController::class], ['GET', 'POST'], 'home');
//Format: /blog/{action}[/{slug}]
$app->route('/blog[/[{action}[/[{slug}]]]]', PostFrontendController::class, ['GET', 'POST'], 'blog');

$app->route('/message[/[{action}]]', MessageController::class, ['GET', 'POST'], 'message');
// following three routes are for user functionality
$app->route('/user/login', LoginAction::class, ['GET', 'POST'], 'login');
$app->route('/user/logout', LogoutAction::class, ['GET'], 'logout');
$app->route('/user[/{action}]', [FrontendUserController::class, UserController::class], ['GET', 'POST'], 'user');

$app->route('/contact[/{action}]', [ContactController::class], ['GET', 'POST'], 'contact');
$app->route('/page[/{action}]', [PageController::class], ['GET', 'POST'], 'page');

$app->route('/test', [\Workshop\Middleware\SimpleMultiLanguageMiddleware::class, \Workshop\Middleware\TestMiddleware::class], ['GET'], 'test');
$app->route('/lang', [\Workshop\Middleware\SimpleMultiLanguageMiddleware::class], ['GET'], 'lang');
$app->route('/dbml', [\Workshop\Middleware\DbMultilanguageMiddleware::class], ['GET'], 'dbml');
