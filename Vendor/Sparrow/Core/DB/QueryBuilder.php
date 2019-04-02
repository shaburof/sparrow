<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 01.04.2019
 * Time: 12:13
 */

namespace Vendor\Sparrow\Core\DB;


class QueryBuilder
{
    protected $query;
    protected $model;
    protected $parameters = [];
    protected $andOr = false;

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

    public function delete()
    {
        $this->query = "DELETE FROM {$this->model} ";

        return $this;
    }

    public function insert($values)
    {
        $parsedValues=$this->parsingInsertValues($values);
        $this->query="INSERT INTO $this->model ({$parsedValues['parameters']}) VALUES ({$parsedValues['questionMarks']})";
        $this->parameters=$parsedValues['values'];
    }

    public function where($valueOne, $compare, $valueTwo)
    {
        if (!$this->andOr) $this->query .= " WHERE $valueOne $compare ?";
        else $this->query .= " $valueOne $compare ?";

        array_push($this->parameters, $valueTwo);
        return $this;
    }

    public function and()
    {
        $this->andOr = true;
        $this->query .= ' AND ';

        return $this;
    }

    public function or()
    {
        $this->andOr = true;
        $this->query .= ' OR ';

        return $this;
    }

    public function build()
    {
        return [$this->query, $this->parameters];
    }

    protected function parsingParameters($parameters, $default): string
    {
        $parseParameters = '';
        if (empty($parameters)) {
            $parseParameters = $default;
        } elseif (is_array($parameters)) {
            foreach ($parameters as $parameter) {
                $parseParameters .= $parameter . ',';
            }
            $parseParameters = rtrim($parseParameters, ',');
        } elseif (is_string($parameters)) {
            $parseParameters = $parameters;
        }

        return htmlspecialchars($parseParameters);
    }

    protected function parsingInsertValues(array $values): array
    {
        $tempParametersString = '';
        $tempValuesString = [];
        $tempQuestionMarks='';

        foreach (array_keys($values) as $value) {
            $tempParametersString .= $value . ',';
            array_push($tempValuesString, $values[$value]);
            $tempQuestionMarks.='?,';
        }
        return [
            'parameters' => rtrim($tempParametersString, ','),
            'values' => $tempValuesString,
            'questionMarks' => rtrim($tempQuestionMarks, ',')
        ];
    }

}
