<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/28/2017
 * Time: 3:16 PM
 */

namespace Workshop\Middleware\Mapper;

use Dot\Mapper\Mapper\AbstractDbMapper;
use Dot\Mapper\Mapper\MapperInterface;

class MultilanguageDbMapper extends AbstractDbMapper implements MapperInterface
{
    protected $table = 'multilanguage';
}
