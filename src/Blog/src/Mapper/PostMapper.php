<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/29/2017
 * Time: 4:01 PM
 */

namespace Apidemia\Blog\Mapper;

use Dot\Mapper\Mapper\AbstractDbMapper;
use Dot\Mapper\Mapper\MapperInterface;

class PostMapper extends AbstractDbMapper implements MapperInterface
{
    protected $table = 'post';
}
