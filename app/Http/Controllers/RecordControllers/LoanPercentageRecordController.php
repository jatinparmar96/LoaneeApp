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
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $records = LoanPercentageRecord::where('loan_id',$id)->where('paid',false)->whereBetween('record_date',[$start_date,$end_date])->get();
        foreach ($records as $record)
        {
            $record->paid = true;
            $record->save();
        }
        return redirect()->back()->with(['success'=>'Records Updated Successfully']);
    }

    public function update_loan_amount(Request $request,$id)
    {
        $loan = LoanPercentage::findOrfail($id);
        $amount = $request->get('amount');
        $loan->paid_amount = $loan->paid_amount + $amount;
        $record_amount = $loan->loan_amount - $loan->paid_amount;
        $record_amount = $record_amount*$loan->percentage/100;
        $records = LoanPercentageRecord::where('loan_id',$id)->where('paid',false)->get();
        foreach ($records as $record)
        {
            $record->record_amount = $record_amount;
            $record->save();
        }
        return redirect()->back()->with(['success'=>'Records Updated Successfully']);
    }
}
