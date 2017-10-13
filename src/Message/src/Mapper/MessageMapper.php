<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 3:55 PM
 */

namespace Apidemia\Message\Mapper;

use Dot\Mapper\Mapper\AbstractDbMapper;
use Dot\Mapper\Mapper\MapperInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;

class MessageMapper extends AbstractDbMapper implements MapperInterface
{
    protected $table = 'message';

    public function getQueryResult($table, $where)
    {
        $sql = $this->getSql();
        $select = $sql->select($table);
        if ($where) {
            foreach ($where as $wh) {
                $select->where($wh);
            }
        }
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);
            $resultSet->initialize($result);

            $data = [];
            $resultSet->next();
            while ($resultSet->valid()) {
                $row = $resultSet->current();

                $data[] = $row;
                $resultSet->next();
            }
            return $data;
        }
        return [];
    }
}
