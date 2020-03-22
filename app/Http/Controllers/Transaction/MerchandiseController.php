<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchandise;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Services\MerchandiseService;

class MerchandiseController extends Controller
{
    protected $MerchandiseService;
    public function __construct(MerchandiseService $MerchandiseService)
    {
        $this->MerchandiseService = $MerchandiseService;
    }
    public function merchandiseListPage()
    {
        $user = Auth::user();
        //每頁資料量
        $rowPerPage = 10;
        //撈取商品分業資料
        $MerchandisePaginate = Merchandise::OrderBy('created_at', 'desc')->where('status', 'S')->paginate($rowPerPage);
        if (!is_null($MerchandisePaginate)) {
            foreach ($MerchandisePaginate as $Merchandise) {
                if (!is_null($Merchandise)) {
                    $Merchandise->photo = url($Merchandise->photo);
                }
            }
        }
        return view('merchandise.listMerchandise', compact('MerchandisePaginate', 'user'));
    }

    public function merchandiseCreateProcess(Request $request)
    {
        //建立商品基本資訊
        $merchandiseData = [
            'status' => 'C', //建立中
            'name' => '', //商品名稱
            'name_en' => '', //商品英文名稱
            'introduction' => '', //商品介紹
            'introduction_en' => '', //商品英文介紹
            'photo' => null, //商品照片
            'price' => 0, //價格
            'remain_count' => 0, //商品剩餘數量
        ];
        $Merchandise = Merchandise::create($merchandiseData);
        return redirect(route('Merchandise.Edit', ['merchandise' => $Merchandise->id]));
    }

    public function merchandiseManageListPage()
    {
        //每頁資料量
        $rowPerPage = 10;
        //撈取商品分頁資料
        $MerchandisePaginate = Merchandise::OrderBy('created_at', 'desc')->paginate($rowPerPage);
        //設定商品圖片網址
        foreach ($MerchandisePaginate as $Merchandise) {
            if (!is_null($Merchandise->photo)) {
                //設定商品圖片網址
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        return view('Merchandise.manageMerchandise', compact('MerchandisePaginate'));
    }

    public function merchandiseItemUpdateProcess(Request $request, Merchandise $merchandise)
    {
        $input = $request->all();
        $this->MerchandiseService->validator($input)->validate();
        // return $input;
        if ($request->hasFile('photo')) {
            //有上傳圖片
            $photo = $request->file('photo');
            $uploadPhoto = $this->MerchandiseService->uploadImg($photo);
            if ($uploadPhoto['status']) {
                $input['photo'] = $uploadPhoto['Path'];
            } else {
                $errors = $uploadPhoto['errors'];
                return redirect()->back()->withErrors($errors);
            }
        }
        $merchandise->update($input);
        return redirect(route('Merchandise.Edit', ['merchandise' => $merchandise->id]));
    }

    public function merchandiseEditPage(Merchandise $merchandise)
    {
        $user = Auth::user();
        if (!is_Null($merchandise->photo)) {
            $merchandise->photo = url($merchandise->photo);
        }
        return view('merchandise.editMerchandise', compact('merchandise', 'user'));
    }

    public function merchandiseItemPage()
    {
        return 103;
    }

    public function merchandiseItemBuyProcess()
    {
        return 104;
    }
}
