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

    // name autoincrement field in table
    protected $id = 'id';

    // :TODO make protected fields name with prefix, or not store attributes in Model class
    protected $model;
    protected $db;
    protected $queryBuilder;
    protected $wasSelected = false;

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

    /*
    * get result from table cast as object, $as=[all,first,last]
    */
    protected function getDataFromDatabase($as, $queryBuilder = null)
    {
        $queryBuilder = empty($queryBuilder) ? $this->queryBuilder : $queryBuilder;
        $query = $queryBuilder->build();

        $queryBuilder->clearQuery();

        $model = $this->db->raw($query)->$as();

        if (isJson()) return JSON($this->markWasSelectedAttribute($model));
        else return $this->markWasSelectedAttribute($model);

    }

    public function query($cf)
    {
        $cf($this->queryBuilder);
//        return $this->get();
    }
}
