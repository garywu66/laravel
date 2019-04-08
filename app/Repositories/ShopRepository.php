<?php

namespace App\Repositories;

use App\Message;
use App\Entities\Shop;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ShopRepository
{
    /** 注入的門市 Entity */
    protected $shop;

    /**
     * constructor
     * @param Shop $shop
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * 回傳指定通路的所有門市
     * @param integer $limit
     * @return Collection
     */
    public function getAllByChannelIdAndLimit($channel_id, $limit)
    {
        return $this->shop
            ->select('id', 'name')
            ->where('channel_id', $channel_id)
            ->where('status', Shop::STATUS_OK)
            ->orderByDesc('id')
            ->paginate($limit);
    }

    public function getAllWithChannel()
    {
        return $this->shop::with('channel')
            ->where('shops.status', Shop::STATUS_OK)
            ->get();
    }

    /**
     * 新增
     */
    public function store(Request $request, $channel_id)
    {
        // 通路不可新增重複名稱的門市
        if (
            $this->shop
            ->where('channel_id', $channel_id)
            ->where('name', $request->input('name'))
            ->where('status', Shop::STATUS_OK)
            ->count()
        ) {
            return Message::getByCode(Message::DB_DUPLICATED_KEY);
        }
        
        $this->shop->channel_id = $channel_id;
        $this->shop->name = $request->input('name');
        $this->shop->status = Shop::STATUS_OK;

        if (!$this->shop->save()) {
            return Message::getByCode(Message::DB_ERROR);
        }
        return Message::getByCode(Message::OK);
    }

    /**
     * 更新
     */
    public function update(Request $request, $channel_id, $id)
    {
        // 通路不可新增重複名稱的門市
        if (
            $this->shop
            ->where('id', '<>', $id)
            ->where('channel_id', $channel_id)
            ->where('name', $request->input('name'))
            ->where('status', Shop::STATUS_OK)
            ->count()
        ) {
            return Message::getByCode(Message::DB_DUPLICATED_KEY);
        }

        $shop = $this->shop::find($id);
        $shop->name = $request->input('name');

        if (!$shop->save()) {
            return Message::getByCode(Message::DB_ERROR);
        }
        return Message::getByCode(Message::OK);
    }


    /**
     * 刪除
     */
    public function destroy($id)
    {
        $shop = $this->shop::find($id);
        $shop->status = Shop::STATUS_DELETED;

        if ($shop->save()) {
            return Message::getByCode(Message::OK);
        } else {
            return Message::getByCode(Message::DB_ERROR);
        }

        
    }
}
