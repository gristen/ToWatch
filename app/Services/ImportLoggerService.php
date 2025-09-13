<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ImportLoggerService
{
    public function logImport(int $id, int $page, string $idKey, string $pageKey):void
    {
        DB::table('import')->insert([
            $idKey => $id,
            $pageKey => $page,
        ]);


}

}
