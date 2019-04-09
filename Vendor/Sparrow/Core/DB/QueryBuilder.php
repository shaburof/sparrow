<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 01.04.2019
 * Time: 12:13
 */

namespace Vendor\Sparrow\Core\DB;


class QueryBuilder extends QueryBuilderMain
{


    public function __construct($model)
    {
        $this->model = $model;
    }

    public function select($whatSelect = null): QueryBuilder
    {
        $parameters = $this->parsingParameters($whatSelect, '*');
        $this->query = "SELECT {$parameters} FROM {$this->model} ";

        return $this;
    }

    public function where($valueOne, $compare, $valueTwo)
    {
        if (!$this->andOr) $this->query .= " WHERE $valueOne $compare ?";
        else $this->query .= " $valueOne $compare ?";

        array_push($this->parameters, $valueTwo);

        return $this;
    }

    public function insert(array $values): void
    {
        $parsedValues = $this->parsingInsertValues($values);
        $this->query = "INSERT INTO $this->model ({$parsedValues['parameters']}) VALUES ({$parsedValues['questionMarks']})";
        $this->parameters = $parsedValues['values'];
    }

    public function update(array $values): void
    {
        $parsedValues = $this->parsingValues($values, 'update');
        $this->query = "UPDATE {$this->model} SET {$parsedValues['parameters']} " . $this->ifSelectedReplaceSELECT();
        $this->parameters = array_merge($parsedValues['values'],$this->parameters);

    }


    public function delete(): QueryBuilder
    {
//        if (empty($this->query)) {
//            $this->query = "DELETE FROM {$this->model} ";
//        } else {
        $this->query = "DELETE FROM {$this->model} " . $this->ifSelectedReplaceSELECT();
//        }

        return $this;
    }

// :TODO решить что с этим делать
//    protected function changeIfcheckAlredySelected($query, $parsedValues): array
//    {
//
//        if ($this->alredySeleted !== null) {
//            $query .= " WHERE {$this->alredySeleted[0]} {$this->alredySeleted[1]} ?";
//            array_push($parsedValues, $this->alredySeleted[2]);
//        }
//
//        return [$query, $parsedValues];
//    }


}
