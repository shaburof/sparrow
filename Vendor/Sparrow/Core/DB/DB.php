<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 31.03.19
 * Time: 17:55
 */

namespace Vendor\Sparrow\Core\DB;

use Vendor\Sparrow\Core\Builder;

class DB extends DBMain
{
    /*
     * return true is field is exist in table, or false if not
     */
    public function fieldIsExist(string $field, string $table): bool
    {
        $exist = true;
        try {
            $this->raw(["SELECT {$field} from {$table} LIMIT 1"])->all();
        } catch (\PDOException $e) {
            if ($e->getCode() === '42S22') $exist = false;
            elseif ($e->getCode() === '42S02' && $field === '*') $exist = false;
            else dd($e);
        }

        return $exist;
    }

    public function tableIsExist(string $table): bool
    {
        return $this->fieldIsExist('*', $table);
    }

}
