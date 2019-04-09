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
    public $queryBuilder; // :TODO сделать свойство protected


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
    protected function getDataFromDatabase($as,$queryBuilder=null)
    {
        $queryBuilder=empty($queryBuilder)?$this->queryBuilder:$queryBuilder;

        $query = $queryBuilder->build();

        dump($queryBuilder); // :TODO remove dump

        $queryBuilder->clearQuery();
        return $this->db->raw($query)->$as();
    }

    public function query($cf)
    {
        $cf($this->queryBuilder);
//        return $this->get();
    }
}
