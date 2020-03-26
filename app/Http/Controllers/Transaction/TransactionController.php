<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function transactionListPage(){
        //每頁資料量
        $rowPerPage = 10;

        $user = Auth::user();
        // $Transation = Auth::user()->Transaction->OrderBy('created_at', 'desc')->paginate($row_per_page)->toArray();
        // return $Transation;
        $TransactionPaginate = Transaction::where('user_id',$user->id)->OrderBy('created_at', 'desc')->paginate($rowPerPage);
        foreach ($TransactionPaginate as $Transaction) {
            // return $Transaction->Merchandise;
            if (!is_null($Transaction->Merchandise->photo)){
                $Transaction->Merchandise->photo = url($Transaction->Merchandise->photo);
            }
        }
        return view('Merchandise.tradeList',compact('TransactionPaginate','user'));
    }
}
