<?php

namespace Vendor\Sparrow\Core\Model;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\DB\DB;
use Vendor\Sparrow\Core\DB\DBMain;
use Vendor\Sparrow\Core\DB\QueryBuilder;

class Model
{
    use actions;
    use ModelHelpers;

    protected $model;
    protected $db;
    public $queryBuilder;   // :TODO сделать свойство protected


    public function __construct()
    {
        $this->model = $this->getClassName();
        $this->queryBuilder = Builder::sCreate(QueryBuilder::class, false, $this->getModelName());
        $this->db = Builder::sCreate(DB::class, false, $this->model);
    }

    protected function getClassName(): string
    {
        return get_class($this);
    }

    protected function getModelName(): string
    {
        $fullClassNameArray = explode('\\', $this->model);
        return array_pop($fullClassNameArray);
    }

    public function find($id, $typeOfId = 'id')
    {
        $this->queryBuilder->select()->where($typeOfId, '=', $id);
//        $prepareQuery = $this->db->raw($this->queryBuilder->build());
        $prepareQuery = $this->get();
        return $prepareQuery->first();
    }


    protected function get(): DBMain
    {
        $query = $this->queryBuilder->build();
        $this->queryBuilder->clearQuery();
        return $this->db->raw($query);
    }

    public function query($cf)
    {
        $cf($this->queryBuilder);
        return $this->get();
    }
}
