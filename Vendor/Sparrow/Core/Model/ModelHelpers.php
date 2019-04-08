<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 08.04.2019
 * Time: 14:50
 */

namespace Vendor\Sparrow\Core\Model;


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
                $values += ['updated_at' => now()];
            }
        }
    }
}
