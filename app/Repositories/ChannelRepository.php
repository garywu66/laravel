<?php

namespace App\Repositories;

use App\Entities\Channel;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Message;

class ChannelRepository
{
    /** 注入的通路 Entity */
    protected $channel;

    /**
     * constructor
     * @param Channel $channel
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * 回傳所有通路
     * @param integer $limit
     * @return Collection
     */
    public function getAllByLimit($limit)
    {
        return $this->channel
            ->select('id', 'name')
            ->where('status', Channel::STATUS_OK)
            ->orderByDesc('id')
            ->paginate($limit);
    }

    /**
     * 新增
     */
    public function store(Request $request)
    {
        $this->channel->name = $request->input('name');
        $this->channel->status = Channel::STATUS_OK;

        try{
            $this->channel->save();
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
        $channel = $this->channel::find($id);
        $channel->name = $request->input('name');

        try{
            $channel->save();
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
        $channel = $this->channel::find($id);
        $channel->status = Channel::STATUS_DELETED;

        if ($channel->save()) {
            return Message::getByCode(Message::OK);
        } else {
            return Message::getByCode(Message::DB_ERROR);
        }

        
    }
}
