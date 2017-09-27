<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 4:09 PM
 */
namespace Workshop\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Workshop\Middleware\Service\MultilanguageServiceInterface;
use Zend\Stratigility\MiddlewareInterface;

class DbMultilanguageMiddleware implements MiddlewareInterface
{
    protected $multilanguageService;
    /**
     * @return MultilanguageServiceInterface
     */
    public function getMultilanguageService(): MultilanguageServiceInterface
    {
        return $this->multilanguageService;
    }

    /**
     * @param MultilanguageServiceInterface $multilanguageService
     */
    public function setMultilanguageService(MultilanguageServiceInterface $multilanguageService)
    {
        $this->multilanguageService = $multilanguageService;
    }

    public function __construct(MultilanguageServiceInterface $multilanguageService)
    {
        $this->multilanguageService = $multilanguageService;

    }

    /**
     * Process an incoming request and/or response.
     *
     * Accepts a server-side request and a response instance, and does
     * something with them.
     *
     * If the response is not complete and/or further processing would not
     * interfere with the work done in the middleware, or if the middleware
     * wants to delegate to another process, it can use the `$next` callable
     * if present:
     *
     * <code>
     * return $next($request, $response);
     * </code>
     *
     * Middleware MUST return a response, or the result of $next (which should
     * return a response).
     *
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $langCode = $request->getQueryParams()['lang'] ?? 'en';
        $lang = $this->multilanguageService->getTranslation($langCode);
        $request = $request->withAttribute('multilanguage', $lang);
        return $next($request, $response);
    }
}
