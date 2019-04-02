<?php

namespace Vendor\Sparrow\Core\Model;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\DB\DB;
use Vendor\Sparrow\Core\DB\DBMain;
use Vendor\Sparrow\Core\DB\QueryBuilder;

class Model
{
    use actions;

/*
 * example query
        $m = new \App\Model\footable();
        $foo = $m->query(function ($q) {
            $q->select()->where('id','>=',1);
        })->all();

    example delete:
    $m = new \App\Model\footable();
    $m->delete()->query(function ($q){
        $q->where('id','=',9)->or()->where('id','=',11);
    })

 */
    protected $model;
    protected $db;
    protected $queryBuilder;


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
//        $q=$this->queryBuilder->build();
        $prepareQuery = $this->db->raw($this->queryBuilder->build());

        return $prepareQuery->first();
    }


    protected function get() :DBMain
    {
        return $this->db->raw($this->queryBuilder->build());
    }

    public function query($cf)
    {
        $cf($this->queryBuilder);

        return $this->get();
    }
}
