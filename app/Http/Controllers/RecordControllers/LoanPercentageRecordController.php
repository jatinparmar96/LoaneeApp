<?php

namespace App\Http\Controllers\RecordControllers;

use App\LoanPercentage;
use App\LoanPercentageRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanPercentageRecordController extends Controller
{
    public function pay_single_record(Request $request,$id)
    {
        $loan_record = LoanPercentageRecord::where('loan_id',$id)->where('paid',false)->first();
        $loan_record->paid = true;
        $loan = LoanPercentage::findOrFail($id);
        $loan->paid_amount = $loan_record->record_amount;
        $loan->save();
    }
    public function pay_bulk_record_by_date(Request $request,$id)
    {

    }
}
