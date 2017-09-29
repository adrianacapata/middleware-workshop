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

        $options = [
            'fields' => '*',
            'conditions' => [
                'languageCode' => $language
            ],
        ];

        $mapper = $this->getMapperManager()->get(MultilanguageEntity::class);
        $result = $mapper->find('all', $options);
        $newResult = [];
        foreach ($result as $value) {
             $newResult[$value->getTag()] = $value->getValue();
        }
        return $newResult;
//        return $storage[$language] ?? $storage['en'];
    }
}
