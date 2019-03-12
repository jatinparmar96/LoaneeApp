<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanRecord;
use App\Pentalty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RecordController extends Controller
{
    private $tz = 'Asia/Kolkata';

    public function showRecordView(Request $request)
    {
        return view('Records.all-pending-records');
    }

    public function showBulkRecordView()
    {
        return view('add-bulk-record');
    }

    public function addRecord()
    {

    }

    public function showTodayRecords(Request $request)
    {
        return view('Records.view-today-records');
    }

    public function pay_bulk_records_amount(Request $request, $id)
    {
        $amount = $request->get('bulk_record_amount');
        $records = LoanRecord::where('loan_id', $id)->getPending()->orderBy('record_date', 'asc')->get();
        foreach ($records as $record) {
            if ($record->record_amount <= $amount) {
                $record->paid = true;
                $record->save();
            }
            $amount = $amount - $record->record_amount;
        };
        return redirect()->back()->with(['success' => 'Bulk Amount Added Successfully']);

    }

    public function payBulkRecords(Request $request, $id)
    {
        $start_date = Carbon::createFromFormat('d/m/Y', $request->get('start_date'))->startOfDay();
        $end_date = Carbon::createFromFormat('d/m/Y', $request->get('end_date'))->startOfDay();
        $records = LoanRecord::where('loan_id', $id)->whereBetween('record_date', [$start_date, $end_date])->getPending()->get();
        foreach ($records as $record) {
            $record->paid = true;
            $record->save();
        }
        $record = $records->last();
        if ($record) {
            $this->updatePenalty($id, $record);
        }
        return redirect()->back()->with(['success', 'Bulk Record Updated Successfully']);
    }

    public function updatePenalty($id, $record)
    {

        $record_date = $this->createDate($record->record_date);
        $penalty = Pentalty::where('loan_id', $id)->getPending()->orderBy('penalty_date', 'desc')->first();
        $penalty_date = $this->createDate($penalty->penalty_date);
        if ($record->method === 'Daily') {
            $record_date->addDays(5);
        } else if ($record->method === 'Weekly') {
            $record_date->addDays(7);
        } else {
            $record_date->addDays(30);
        }
        if ($record_date->gte($penalty_date)) {
            $penalty_date = $record_date;
            $penalty->penalty_date = $penalty_date;
            $penalty->save();
        }
    }

    function createDate($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date);
    }

    public function testpayBulkRecords(Request $request)
    {
        $startDate = Input::get('startDate');
        $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->format('Y-m-d');
        $bulkAmount = Input::get('bulk_repay_amount');
        $loan = Loan::find(Input::get('loan_id'));
        $records = LoanRecord::where('loan_id', $loan->id)->where('record_date', '>=', $startDate)->getPending()->get();
        foreach ($records as $record) {
            if ($bulkAmount >= $record->remaining_amount) {
                $record->remaining_amount = 0;
                $record->paid = true;
                $bulkAmount = $bulkAmount - $record->record_amount;
                $record->save();
            } else {
                $record->remaining_amount = abs($record->record_amount - $bulkAmount);
                $record->save();
                break;
            }
        }
        $this->updateLoanStatus($loan->id);

        return redirect()->route('showRecordView')->with(['success', 'Records Updated Successfully']);
    }

    function updateLoanStatus($id)
    {
        $records = LoanRecord::where('loan_id', $id)->getPending()->get();
        $loan = Loan::find($id);
        if (count($records) == 0) {
            $loan->paid = true;
            $loan->save();
        }
    }

    public function getTodayRecords(Request $request)
    {
        $todayRecords = [];
        $count = 0;
        $today = Carbon::today($this->tz);
        $records = LoanRecord::where('record_date', $today)->getPending()->get();
        foreach ($records as $record) {
            $user = $record->getUser()->first();
            $name = $user->name;
            $card_number = $user->card_number;
            $todayRecords[$count] = $record;
            $todayRecords[$count]['name'] = $name;
            $todayRecords[$count]['card_number'] = $card_number;
            $count++;
        }
        return json_encode($todayRecords);
    }

    public function getAllPendingRecords(Request $request)
    {
        $todayRecords = [];
        $today = Carbon::today($this->tz)->format('Y-m-d');
        $loans = Loan::all();
        foreach ($loans as $loan) {
            $record = LoanRecord::where([
                ['loan_id', $loan->id]
            ])->getPending()->first();
            if ($record) {
                $user = $record->getUser()->first();
                $record->name = $user->name;
                $record->card_number = $user->card_number;
                array_push($todayRecords, $record);
            }
        }
        return json_encode($todayRecords);
    }

    public function pending_list()
    {
        $data = $this->query()->get();
        return json_encode($data);
    }

    public function query()
    {
        $query = DB::table('loan_records as lr')
            ->leftJoin('loans as l', 'l.id', '=', 'lr.loan_id')
            ->leftJoin('pentalties as p', 'l.id', 'p.loan_id')
            ->leftJoin('loan_users as u', 'u.id', 'l.user_id')
            ->select('l.id as loan_id')
            ->addSelect('lr.record_amount as remaining_amount', 'lr.record_date')
            ->addSelect('p.amount as penalty_amount')
            ->addSelect('u.name', 'u.card_number')
            ->where('lr.paid', false)
            ->where('p.paid', false)
            ->groupBy('lr.loan_id');
        return $query;
    }

    public function payHalfRecord($id)
    {
        $record = LoanRecord::find($id);
        $loan_id = $record->getloan()->first();
        $record->remaining_amount = $record->remaining_amount - Input::get('half-price');
        if ($record->remaining_amount == 0) {
            $record->paid = 1;
        }
        try {
            $record->save();
            $this->updateLoanStatus($loan_id);
            return redirect()->back()->with(['success' => 'Record Amount saved Successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function payFullRecord($id)
    {
        $record = LoanRecord::where('loan_id',$id)->getPending()->orderBy('record_date','asc')->first();
        $loan_id = $id;
        $record->paid = 1;
        $record->save();
        $this->updatePenalty($loan_id, $record);
        $this->updateLoanStatus($loan_id);
        return redirect()->back()->with(['success' => 'Record Paid Successfully']);
    }
}
