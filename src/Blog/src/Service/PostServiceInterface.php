<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/29/2017
 * Time: 4:03 PM
 */

namespace Apidemia\Blog\Service;

use Apidemia\Blog\Entity\PostEntity;

interface PostServiceInterface
{
    public function getPosts();

    public function createPost(PostEntity $post);

    public function updatePost(PostEntity $slug);

    public function deletePost(PostEntity $slug);
}
