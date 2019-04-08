<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * 門市
 * @property int $id
 * @property int $channel_id
 * @property string $name
 * @property string $status 狀態
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Shop extends Model
{
    protected $table = 'shops';

    const STATUS_OK = 'ok';
    const STATUS_DELETED = 'deleted';

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
