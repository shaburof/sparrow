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
    // get all data
    public function all()
    {
        return $this->get();
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

    public function insert(array $values): void
    {
        $this->updateDateTimeIfSet($values, 'insert');  // create or update dateTime in created_at and updated_at fields if they are
        $this->queryBuilder->insert($values);
        $this->get();
    }


//    public function delete(): object
//    {
//        $this->queryBuilder->delete();
//
//        if ($this->checkAlredySelected()) return $this->get();
//        else return $this;
//    }
//

//
//    public function update(array $values): object
//    {
//        $this->updateDateTimeIfSet($values,'update');
//        $this->queryBuilder->update($values);
//        if ($this->checkAlredySelected()) return $this->get();
//        return $this;
//    }
//
//    protected function checkAlredySelected(): bool
//    {
//        return $this->queryBuilder->getAlredySelected() !== null;
//    }

}
