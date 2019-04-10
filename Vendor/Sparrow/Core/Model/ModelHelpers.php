<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 08.04.2019
 * Time: 14:50
 */

namespace Vendor\Sparrow\Core\Model;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\JSON\handlerJson;

trait ModelHelpers
{
    protected function fieldIsExist(string $field): bool
    {
        return $this->db->fieldIsExist($field, $this->getModelName());
    }

    /*
     * add created_at and updated_at or change updated_at fields in table if they are present
     */
    public function updateDateTimeIfSet(array &$values, $action): void
    {
        if ($this->fieldIsExist('created_at') && $this->fieldIsExist('updated_at')) {
            if ($action === 'insert') {
                $values += ['created_at' => now()];
                $values += ['updated_at' => now()];
            } elseif ($action === 'update') {
                if (empty($values['updated_at'])) $values += ['updated_at' => now()];
                else $values['updated_at'] = now();
            }
        }
    }


    //throw Error if 'id' field is empty
    protected function checkIdIsNotEmpty(array $values): void
    {
        if (empty($values[$this->id])) throw new Errors("| $this->id field is missing |");
    }

    protected function markWasSelectedAttribute($model)
    {
        if (is_object($model)) $model->wasSelected = true;
        elseif (is_array($model)) {
            $model = array_map(function ($item) {
                $item->wasSelected = true;
                return $item;
            }, $model);
        }
        return $model;
    }


}
