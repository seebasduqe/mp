<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Error Handler
 * @filename: ErrorHandler.php
 * Location: _app/_models/_class
 * @Creator: F.Pastor (FPP) <info@novaigrup.com>
 * 	20221104 FPP Created
 */


class ErrorHandler extends Model
{
    //Define table name of bdd
    protected $table = 'error_handler';

    //Define primary key
    protected $primaryKey = 'id';

    protected $fillable = [
        'message',
        'code',
        'file',
        'line',
        'created_at',
        'updated_at'

    ];

    public function saveError($exception)
    {

        if (!$exception)
        {
            return false;
        }
        ErrorHandler::insert([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return true;
    }
}
