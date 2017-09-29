<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/29/2017
 * Time: 3:57 PM
 */

namespace Apidemia\Blog\Service;

use Apidemia\Blog\Entity\PostEntity;
use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;

class PostService implements MapperManagerAwareInterface, PostServiceInterface
{
    use MapperManagerAwareTrait;

    public function getPosts()
    {
        $storage = [
            'id' => 1,
            'title' => 'title1',
            'slug' => 'slug',
            'content' => 'content',
            'userId' => 1,
            'publishDate' => 28
        ];

        $options = [
            'fields' => '*'
        ];

        $mapper = $this->getMapperManager()->get(PostEntity::class);
        $result = $mapper->find('all', $options);
        return $result;
    }

    public function createPost(PostEntity $post)
    {
        // TODO: Implement createPost() method.
    }

    public function updatePost(PostEntity $slug)
    {
        // TODO: Implement updatePost() method.
    }

    public function deletePost(PostEntity $slug)
    {
        // TODO: Implement deletePost() method.
    }
}
