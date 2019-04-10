<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 09.04.2019
 * Time: 10:17
 */

namespace Vendor\Sparrow\Core\DB;


class QueryBuilderMain
{
    protected $query;
    protected $parameters = [];
    protected $andOr = false;
    protected $model;

    /*
 * build query like ['select * from footable where id = ?',1];
 */
    public function build(): array
    {
        return [$this->query, $this->parameters];
    }

    public function clearQuery(): void
    {
        unset($this->query);
        $this->parameters = [];
    }

    /*
     * $parameters string or array
     * parsingParameters('id'); or parsingParameters(['id','name']);
     * return string "id,name..."
     */
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

    /*
     *  $values array like  ['title' => 'foo','description' => 'bar']
     *  return array like ['parameters'=>'title,description','values'=>['foo','bar'],'questionMarks'=>'?,?'];
     */
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

    // если в свойстве $this->query сформирован селект, меняем SELECT на $replaceOn. Для методов update(), delete()
    protected function ifSelectedReplaceSELECT(): ?string
    {
        if (!empty($this->query)) return preg_replace("/SELECT.+FROM +{$this->model}/i", "", $this->query);

        return null;
    }

    // :TODO решить что с этим делать
//    protected function insertCount(): ?string
//    {
//        if (!empty($this->query)) return preg_replace('/select.+FROM/i','SELECT COUNT(*) as count FROM', $this->query);
//        return $this->query;
//    }

}
