<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ShopRepository;

/**
 * 門市
 */
class ShopController extends Controller
{

    /** 注入的 ShopRepository */
    protected $ShopRepository;

    /**
     * constructor
     *
     * @param ShopRepository $shopRepository
     */
    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * 列表
     */
    public function index(Request $request, $channel_id)
    {
        $limit = $request->input('limit');
        return $this->shopRepository->getAllByChannelIdAndLimit($channel_id, $limit);
    }

    public function getAllWithChannel()
    {
        return $this->shopRepository->getAllWithChannel();
    }

    /**
     * 新增
     */
    public function store(Request $request, $channel_id)
    {
        return $this->shopRepository->store($request, $channel_id);
    }

    /**
     * 更新
     */
    public function update(Request $request, $channel_id, $id)
    {
        return $this->shopRepository->update($request, $channel_id, $id);
    }

    /**
     * 刪除
     */
    public function destroy($channel_id, $id)
    {
        return $this->shopRepository->destroy($id);
    }
}
