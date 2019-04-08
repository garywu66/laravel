<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * 廣告機
 * @property int $id
 * @property int $shop_id
 * @property string $name
 * @property string $status 狀態
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Device extends Model
{
    protected $table = 'devices';

    const STATUS_OK = 'ok';
    const STATUS_DELETED = 'deleted';
}
