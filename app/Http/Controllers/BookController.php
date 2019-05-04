<?php

namespace App\Http\Controllers;

use App\Http\Proxy\ApiProxy;
use App\Model\Book;
use App\Repositories\ReadRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BookController extends Controller
{

    protected $readRepository;
    protected $apiProxy;
    const API_BASIC = 'http://api.zhuishushenqi.com';
    const NOVEL_COVER_URL = 'http://statics.zhuishushenqi.com';

    public function __construct(ApiProxy $apiProxy,ReadRepository $readRepository)
    {
        $this->apiProxy = $apiProxy;
        $this->readRepository = $readRepository;
    }
    
    public function category()
    {
        $router = '/cats/lv2/statistics';
        $response = $this->apiProxy->get(self::API_BASIC,$router);
        return $response;
    }

    public function novelList()
    {
        $gender = \request('gender');
        $type = \request('type');
        $major = \request('major');
        $minor = \request('minor');
        $start = 0;
        $limit = 20;
        $router = '/book/by-categories?gender='.$gender.'&type='.$type.'&major='.$major.'&minor='.$minor.'&start='.$start.'&limit='.$limit;
        $response = $this->apiProxy->get(self::API_BASIC,$router);
        return $response;
    }

    public function catDetail()
    {
        $router = '/cats/lv2';
        $response = $this->apiProxy->get(self::API_BASIC,$router);
        return $response;
    }

    public function getBook()
    {
        $bookId = \request('bookId');
        $router = '/book/'.$bookId;
        $response = $this->apiProxy->get(self::API_BASIC,$router);
//        $book = Book::where('book_id',$response->_id)->first();
//        if (!$book){
//            Book::create(['book_id'=>$response->_id,'title'=>$response->title]);
//        }
        return $response;
    }
}
