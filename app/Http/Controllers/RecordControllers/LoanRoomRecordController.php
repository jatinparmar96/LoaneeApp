<?php

namespace App\Http\Controllers\RecordControllers;

use App\Http\Controllers\Controller;
use App\LoanRoom;
use App\LoanRoomRecord;
use Illuminate\Http\Request;

class LoanRoomRecordController extends Controller
{
    public function pay_single_record(Request $request, $id)
    {
        $loan_record = LoanRoomRecord::where('loan_id', $id)->where('paid', false)->first();
        $loan_record->paid = true;
        $loan = LoanRoom::findOrFail($id);
        $loan->paid_amount = $loan_record->record_amount;
        $loan->save();
    }

    public function pay_bulk_record_by_date(Request $request, $id)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $records = LoanRoomRecord::where('loan_id', $id)->where('paid', false)->whereBetween('record_date', [$start_date, $end_date])->get();
        foreach ($records as $record) {
            $record->paid = true;
            $record->save();
        }
        return redirect()->back()->with(['success' => 'Records Updated Successfully']);
    }

    public function update_loan_amount(Request $request, $id)
    {
        $loan = LoanRoom::findOrfail($id);
        $reduce = 0;
        $amount = $request->get('amount');
        if ($amount % 5 === 0 && ($amount / 50000) >= 1) {
            //$reduce is the amount to be reduced in each installment
            if ($loan->installment === 1500) {
                $reduce = 750 * ($amount / 50000);
            } else {
                $reduce = 1150 * ($amount / 50000);
            }
        }
        $records = LoanRoomRecord::where('loan_id', $id)->where('paid', false)->get();
        foreach ($records as $record) {
            $record->record_amount = $record->record_amount - $reduce;
            $record->save();
        }
        return redirect()->back()->with(['success' => 'Records Updated Successfully']);
    }
}
