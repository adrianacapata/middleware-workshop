<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 4:17 PM
 */

namespace Workshop\Middleware\Service;

interface MultilanguageServiceInterface
{
    public function getTranslation($language);
}
