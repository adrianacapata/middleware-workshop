<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 2:55 PM
 */

namespace Workshop\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SimpleMultiLanguageMiddleware
{
    public function __invoke(ServerRequestInterface $req, ResponseInterface $res, callable $next = null)
    {
     $storage = [
                 'en' => [
                     'title1' => 'hello',
                     'title2' => 'goodbye'
                 ],

                 'ro' => [
                     'title1' => 'salut',
                     'title2' => 'la revedere'
                 ]
             ];

     $langCode =$req->getQueryParams()['lang'] ?? 'en';

     $req = $req->withAttribute('multilanguage', $storage[$langCode] ?? $storage['en']);
     return $next($req, $res);
    }
}
