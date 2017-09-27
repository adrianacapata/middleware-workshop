<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 4:20 PM
 */

namespace Workshop\Middleware\Service;

class MultilanguageService implements MultilanguageServiceInterface
{
    public function getTranslation($language)
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
        return $storage[$language] ?? $storage['en'];
    }
}
