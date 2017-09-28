<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 4:20 PM
 */

namespace Workshop\Middleware\Service;

use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;
use Workshop\Middleware\Entity\MultilanguageEntity;

class MultilanguageService implements MultilanguageServiceInterface, MapperManagerAwareInterface
{
    use MapperManagerAwareTrait;

    public function getTranslation($language)
    {
       /* $storage = [
            'en' => [
                'title1' => 'hello',
                'title2' => 'goodbye'
            ],

            'ro' => [
                'title1' => 'salut',
                'title2' => 'la revedere'
            ]
        ]; */

        $options = [
            'fields' => '*',
            'conditions' => [
                'languageCode' => 'en'
            ],
        ];
        $mapper = $this->getMapperManager()->get(MultilanguageEntity::class);
        $result = $mapper->find('all', $options);
        foreach ($result as $value) {
            $newResult[$value->getTag()] = $value->getValue();
        }
        return $newResult;
//        return $storage[$language] ?? $storage['en'];
    }
}
