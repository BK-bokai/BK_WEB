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
        $TransactionPaginate = Transaction::where('user_id',$user->id)->OrderBy('created_at', 'desc')->paginate($rowPerPage);
        foreach ($TransactionPaginate as $Transaction) {
            // return $Transaction->Merchandise;
            // return $Transaction->Merchandise->photo;
            if (!is_null($Transaction->Merchandise->photo)){
                $Transaction->Merchandise->photo = url($Transaction->Merchandise->photo);
            }
        }
        return view('Merchandise.tradeList',compact('TransactionPaginate','user'));
    }
}
