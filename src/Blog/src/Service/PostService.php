<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/29/2017
 * Time: 3:57 PM
 */

namespace Apidemia\Blog\Service;

use Apidemia\Blog\Entity\PostEntity;
use Dot\Mapper\Entity\EntityInterface;
use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;

class PostService implements MapperManagerAwareInterface, PostServiceInterface
{
    use MapperManagerAwareTrait;

    public function getPosts($slug = '')
    {
        $options = [
            'fields' => '*'
        ];

        if ($slug) {
            $options = [
                'conditions' => [
                    'slug' => $slug
                ]
            ];
        }
        $mapper = $this->getMapperManager()->get(PostEntity::class);
        $result = $mapper->find('all', $options);
        return $result;
    }
/*
    public function getPost($slug = '')
    {
        $mapper = $this->getMapperManager()->get(PostEntity::class);
        $result = $mapper->get($slug);
        return $result;
    }
*/
    public function createPost(PostEntity $post)
    {
        $mapper = $this->getMapperManager()->get(PostEntity::class);
        return $result = $mapper->save($post);
//        return $result;
    }

    public function updatePost($slug, PostEntity $post)
    {
        $options = [
            'conditions' => [
                'slug' => $slug
            ],
        ];

        $mapper = $this->getMapperManager()->get(PostEntity::class);
        return $result = $mapper->save($post);
//        return $result;
    }

    public function deletePost($slug)
    {
        $mapper = $this->getMapperManager()->get(PostEntity::class);
        $post = current($this->getPosts($slug));
        $result = $mapper->delete($post);
        return $result;
    }
}
