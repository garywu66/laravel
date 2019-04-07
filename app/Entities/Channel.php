<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * 通路
 * @property int $id
 * @property string $name
 * @property string $status 狀態
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Channel extends Model
{
    protected $table = 'channels';

    const STATUS_OK = 'ok';
    const STATUS_DELETED = 'deleted';
}
