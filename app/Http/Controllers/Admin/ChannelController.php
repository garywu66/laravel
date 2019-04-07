<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;

class ChannelController extends Controller
{

    /** 注入的 ChannelRepository */
    protected $channelRepository;

    /**
     * constructor
     *
     * @param ChannelRepository $channelRepository
     */
    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    /**
     * 列表
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        return $this->channelRepository->getAllByLimit($limit);
    }

    /**
     * 新增
     */
    public function store(Request $request)
    {
        return $this->channelRepository->store($request);
    }

    /**
     * 更新
     */
    public function update(Request $request, $id)
    {
        return $this->channelRepository->update($request, $id);
    }

    /**
     * 刪除
     */
    public function destroy($id)
    {
        return $this->channelRepository->destroy($id);
    }
}
