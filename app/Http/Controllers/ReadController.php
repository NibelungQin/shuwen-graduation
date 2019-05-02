<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReadResource;
use App\Repositories\ReadRepository;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    protected $readRepository;

    public function __construct(ReadRepository $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    /**
     * 浏览记录列表
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $reads = $this->readRepository->getReadLog();
        foreach ($reads as $key=>$read){
            $reads[$key]['type'] = class_basename($read['readable_type']);
            $reads[$key]['readable'] = $read->readable;
            $reads[$key]['created_diff'] = $read->updated_at->diffForHumans();
        }
        return ReadResource::collection($reads);
    }

    public function show()
    {

    }
}
