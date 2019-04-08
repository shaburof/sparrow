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
    protected $alredySeleted = null;

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
        $query="DELETE FROM {$this->model} ";
        $parameters=[];

        [$query, $parameters] = $this->changeIfcheckAlredySelected($query, $parameters);

        $this->query = $query;
        $this->parameters = $parameters;
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
        $query = "UPDATE {$this->model} SET {$parsedValues['parameters']}";
        $parameters = $parsedValues['values'];

        [$query, $parameters] = $this->changeIfcheckAlredySelected($query, $parameters);

        $this->query = $query;
        $this->parameters = $parameters;

    }

    protected function changeIfcheckAlredySelected($query, $parsedValues): array
    {

        if ($this->alredySeleted !== null) {
            $query .= " WHERE {$this->alredySeleted[0]} {$this->alredySeleted[1]} ?";
            array_push($parsedValues, $this->alredySeleted[2]);
        }

        return [$query, $parsedValues];
    }

    public function where($valueOne, $compare, $valueTwo)
    {
        if (!$this->andOr) $this->query .= " WHERE $valueOne $compare ?";
        else $this->query .= " $valueOne $compare ?";

        array_push($this->parameters, $valueTwo);

        if (!$this->alredySeleted) $this->alredySeleted = [$valueOne, $compare, $valueTwo];

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

    public function clearQuery(): void
    {
        unset($this->query);
        $this->parameters = [];
    }

    public function getAlredySelected(): ?array
    {
        return $this->alredySeleted;
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
        $tempQuestionMarks = '';

        foreach (array_keys($values) as $value) {
            $tempParametersString .= $value . ',';
            array_push($tempValuesString, $values[$value]);
            $tempQuestionMarks .= '?,';
        }
        return [
            'parameters' => rtrim($tempParametersString, ','),
            'values' => $tempValuesString,
            'questionMarks' => rtrim($tempQuestionMarks, ',')
        ];
    }

    protected function parsingValues(array $values, $action): array
    {
        $tempParametersString = '';
        $tempValuesString = [];
        $tempQuestionMarks = '';

        if ($action === 'insert') {
            foreach (array_keys($values) as $value) {
                $tempParametersString .= $value . ',';
                array_push($tempValuesString, $values[$value]);
                $tempQuestionMarks .= '?,';
            }
        } elseif ($action === 'update') {
            foreach (array_keys($values) as $value) {
                $tempParametersString .= "{$value} = ?,";
                array_push($tempValuesString, $values[$value]);
            }
        }
        return [
            'parameters' => rtrim($tempParametersString, ','),
            'values' => $tempValuesString,
            'questionMarks' => rtrim($tempQuestionMarks, ',')
        ];
    }

}
