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
//    public function select($whatToSelect = null, $query): DBMain
//    {
//        if (!empty($query) && is_object($query)) {
//            $this->queryBuilder->select($whatToSelect);
//            $query($this->queryBuilder);
//        } else {
//            $this->queryBuilder->select($whatToSelect);
//        }
//        return $this->get();
//    }
    public function select($whatToSelect = null): Model
    {
        $this->queryBuilder->select($whatToSelect);
        return $this;
    }

    public function delete(): object
    {
        $this->queryBuilder->delete();

        if ($this->checkAlredySelected()) return $this->get();
        else return $this;
    }

    public function insert(array $values): void
    {
        $this->updateDateTimeIfSet($values,'insert');
        $this->queryBuilder->insert($values);
        $this->get();
    }

    public function update(array $values): object
    {
        $this->updateDateTimeIfSet($values,'update');
        $this->queryBuilder->update($values);
        if ($this->checkAlredySelected()) return $this->get();
        return $this;
    }

    protected function checkAlredySelected(): bool
    {
        return $this->queryBuilder->getAlredySelected() !== null;
    }

}
