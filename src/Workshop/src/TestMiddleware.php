<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 2:38 PM
 */

namespace Workshop\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Workshop\Middleware\Service\MultilanguageService;
use Zend\Diactoros\Response\HtmlResponse;

class TestMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $ml = $request->getAttribute('multilanguage');
        $title = $ml['title1'] ?? 'no';

        return new HtmlResponse($title);
    }
}
