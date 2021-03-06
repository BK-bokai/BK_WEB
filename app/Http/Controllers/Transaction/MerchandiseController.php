<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchandise;
use Auth;
use Exception;
use DB;
use Illuminate\Support\Facades\Log;
use App\Services\MerchandiseService;
use App\Models\Transaction;

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
                if (!is_null($Merchandise->photo)) {
                    $Merchandise->photo = url($Merchandise->photo);
                }
            }
        }
        return view('Merchandise.listMerchandise', compact('MerchandisePaginate', 'user'));
    }

    public function merchandiseManageListPage()
    {
        $user = Auth::user();
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
        return view('Merchandise.manageMerchandise', compact('MerchandisePaginate', 'user'));
    }

    public function merchandiseDelete(Request $request, Merchandise $merchandise){
        if(!is_null($merchandise->photo)){
            unlink(public_path($merchandise->photo));
        }
        $merchandise->delete();
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



    public function merchandiseItemUpdateProcess(Request $request, Merchandise $merchandise)
    {
        $input = $request->all();
        $this->MerchandiseService->createValidator($input)->validate();
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

    public function merchandiseItemPage(Request $request, Merchandise $Merchandise)
    {
        if (!is_null($Merchandise->photo)) {
            $Merchandise->photo = url($Merchandise->photo);
        }
        return view('Merchandise.showMerchandise', compact('Merchandise'));
    }

    public function merchandiseItemBuyProcess(Request $request,Merchandise $Merchandise)
    {
        //接收輸入資料
        $input = request()->all();
        $this->MerchandiseService->buyValidator($input)->validate();

        try {
            //交易開始
            DB::beginTransaction();

            $buyCount = $input['buyCount'];
            $remainCountAfterBuy = $Merchandise->remain_count - $buyCount;
            if ($remainCountAfterBuy < 0) {
                //購買後剩餘數量小於0，不足以賣給使用者
                throw new Exception('商品數量不足，無法購買');
            }
            //控制金流
            //控制金流結束

            $Merchandise->remain_count = $remainCountAfterBuy;
            $Merchandise->save();

            $totalPrice = $buyCount * $Merchandise->price;
            $transaction_data = [
                // 'user_id' => $user->id,
                'merchandise_id' => $Merchandise->id,
                'price' => $Merchandise->price,
                'buy_count' => $buyCount,
                'total_price' => $totalPrice,
            ];
            $transaction = new Transaction($transaction_data);
            Auth::user()->Transaction()->save($transaction);
            DB::commit();

            // return redirect(route('Merchandise.Item', ['Merchandise' => $Merchandise->id]))
            //     ->with('status', '已購買成功');
            return redirect()->route('trade');
        } catch (Exception $exception) {
            //恢復原先交易狀態
            DB::rollBack();

            return redirect()
                ->back()
                ->with('status',  $exception->getMessage());
        }

    }
}
