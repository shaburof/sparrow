<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 01.04.2019
 * Time: 16:49
 */

namespace Vendor\Sparrow\Core\Model;


use Vendor\Sparrow\Core\DB\DBMain;

trait actions
{
    public function select($whatToSelect = null,$query): DBMain
    {
        if (!empty($query) && is_object($query)) {
            $this->queryBuilder->select($whatToSelect);
            $query($this->queryBuilder);
        } else {
            $this->queryBuilder->select($whatToSelect);
        }
        return $this->get();
//        return $this;
    }

    public function delete(): Model
    {
        $this->queryBuilder->delete();
        return $this;
    }

    public function insert(array $values): void
    {
        $this->queryBuilder->insert($values);
        $this->get();
    }
}
