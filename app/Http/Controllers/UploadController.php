<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 文件上传
 * Class UploadController
 * @package App\Http\Controllers
 */
class UploadController extends Controller
{
    /**
     * QuillEditor富文本编辑器中上传图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function image(Request $request)
    {
        $file = $request->file('img');
        $fileName = md5(time()).user('api').'.'.$file->getClientOriginalExtension();
        $filePath = 'uploads/image/';
        $file->move($filePath,$fileName);
        return response()->json([
            'status'=>user('api'),
            'imgUrl'=>'/'.$filePath.$fileName
        ],200);
    }
}
