<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Functions
{
    public static function truncateTable(string $table): null
    {
        return DB::table($table)->truncate();
    }
}
