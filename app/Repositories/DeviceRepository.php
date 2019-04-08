<?php

namespace App\Repositories;

use App\Entities\Device;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Message;

class DeviceRepository
{
    /** 注入的廣告機 Entity */
    protected $device;

    /**
     * constructor
     * @param Device $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * 回傳所有廣告機
     * @param integer $limit
     * @return Collection
     */
    public function getAllByLimit($limit)
    {
        return $this->device
            ->select('devices.id', 'devices.name', 'devices.shop_id', 'channels.name as channel_name', 'shops.name as shop_name')
            ->leftJoin('shops', 'shops.id', '=', 'devices.shop_id')
            ->leftJoin('channels', 'channels.id', '=', 'shops.channel_id')
            ->where('devices.status', Device::STATUS_OK)
            ->orderByDesc('devices.id')
            ->paginate($limit);
    }

    /**
     * 新增
     */
    public function store(Request $request)
    {
        $this->device->name = $request->input('name');
        $this->device->shop_id = $request->input('shop_id');
        $this->device->status = Device::STATUS_OK;

        try{
            $this->device->save();
        }catch (QueryException $e){
            if ($e->getCode() === '23000') {
                return Message::getByCode(Message::DB_DUPLICATED_KEY);
            }
            return Message::getByCode(Message::DB_ERROR);
        }
        return Message::getByCode(Message::OK);
    }

    /**
     * 更新
     */
    public function update(Request $request, $id)
    {
        $device = $this->device::find($id);
        $device->name = $request->input('name');
        $device->shop_id = $request->input('shop_id');

        try{
            $device->save();
        }catch (QueryException $e){
            if ($e->getCode() === '23000') {
                return Message::getByCode(Message::DB_DUPLICATED_KEY);
            }
            return Message::getByCode(Message::DB_ERROR);
        }
        return Message::getByCode(Message::OK);
    }


    /**
     * 刪除
     */
    public function destroy($id)
    {
        $device = $this->device::find($id);
        $device->status = Device::STATUS_DELETED;

        if ($device->save()) {
            return Message::getByCode(Message::OK);
        } else {
            return Message::getByCode(Message::DB_ERROR);
        }

        
    }
}
