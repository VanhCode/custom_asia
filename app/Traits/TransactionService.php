<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait TransactionService
{
    public function execute(callable $callback)
    {
        DB::beginTransaction();

        try {
            $callback();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message :' . $exception->getMessage() . ' line :' . $exception->getLine());
            throw $exception;
        }
    }
}
