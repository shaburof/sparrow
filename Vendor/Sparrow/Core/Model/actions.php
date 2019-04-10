<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 01.04.2019
 * Time: 16:49
 */

namespace Vendor\Sparrow\Core\Model;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\DB\DBMain;
use Vendor\Sparrow\Core\DB\QueryBuilder;
use Vendor\Sparrow\Core\Errors\Errors;

trait actions
{
    // execute PDO query without fetching data
    public function execute()
    {
        $query = $this->queryBuilder->build();
        $this->queryBuilder->clearQuery();
        return $this->db->raw($query)->status();
    }

    // get last inserted id
    protected function getLastInsertId()
    {
        return $this->getDataFromDatabase('getLastInsertId');
    }

    // get all data
    public function all()
    {
        return $this->getDataFromDatabase('all');
    }

    // get all data
    public function get()
    {
        return $this->getDataFromDatabase('all');
    }

    // get first
    public function first()
    {
        return $this->getDataFromDatabase('first');
    }

    // get last
    public function last()
    {
        return $this->getDataFromDatabase('last');
    }

    public function select($whatToSelect = null): Model
    {
        $this->queryBuilder->select($whatToSelect);
        return $this;
    }

    public function where($valueOne, $compare = null, $valueTwo = null): Model
    {
        if ($valueOne instanceof \Closure) {
            $this->query($valueOne);
        } elseif (!empty($valueOne) && !isset($compare, $valueTwo)) {
            $this->queryBuilder->where($this->id, '=', $valueOne);
        } else {
            $this->queryBuilder->where($valueOne, $compare, $valueTwo);
        }

        return $this;
    }

    public function find($id, string $typeOfId = 'id'): Model
    {
        $this->select()->where($typeOfId, '=', $id);
        return $this;
    }

    public function insert(array $values): ?int
    {
        $this->updateDateTimeIfSet($values, 'insert');  // create or update dateTime in created_at and updated_at fields if they are
        $this->queryBuilder->insert($values);

        return $this->getLastInsertId();
    }

    public function update(array $values): Model
    {

        $this->updateDateTimeIfSet($values, 'update');  // create or update dateTime in created_at and updated_at fields if they are
        $this->queryBuilder->update($values);
        return $this;
    }

    public function delete()
    {
        if ($this->wasSelected) {
            $values = getVars($this);
            $this->checkIdIsNotEmpty($values);
            $this->where($values[$this->id]);
        }
        $this->queryBuilder->delete();

        return $this;
    }

    public function save()
    {
        $id = $this->id;

        $values = getVars($this);
        if ($this->wasSelected) {
            $this->checkIdIsNotEmpty($values);

            $this->where($values[$id]);
            unset($values[$id]);
            $result = $this->update($values)->execute();
        } else {
            $result = $this->insert($values);
        }

        return $result;
    }

}
