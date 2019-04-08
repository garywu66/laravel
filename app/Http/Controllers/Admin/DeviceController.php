<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\DeviceRepository;

class DeviceController extends Controller
{

    /** 注入的 DeviceRepository */
    protected $deviceRepository;

    /**
     * constructor
     *
     * @param DeviceRepository $deviceRepository
     */
    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * 列表
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        return $this->deviceRepository->getAllByLimit($limit);
    }

    /**
     * 新增
     */
    public function store(Request $request)
    {
        return $this->deviceRepository->store($request);
    }

    /**
     * 更新
     */
    public function update(Request $request, $id)
    {
        return $this->deviceRepository->update($request, $id);
    }

    /**
     * 刪除
     */
    public function destroy($id)
    {
        return $this->deviceRepository->destroy($id);
    }
}
