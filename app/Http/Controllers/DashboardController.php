<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use Illuminate\Support\Facades\DB;
use App\LoanRecord;
use App\Settings;
use App\Pentalty;

class DashboardController extends Controller
{
   public function index()
   {
        $query =  Loan::where('paid',0)->pluck('repay_amount');
        $loans = $query->count();
        $loan_amount = $query->sum();
        $pending_amount = LoanRecord::where('paid',false)->pluck('record_amount')->sum();
        $setting = Settings::where('option','penalty')->first();
        if(!$setting)
        {
            $setting = $this->createPenaltySetting();
        }
        $penalty_amount = Pentalty::where('paid',false)->pluck('amount')->sum();
       return view('dashboard',compact('loans','loan_amount','pending_amount','setting','penalty_amount'));
   }
   function createPenaltySetting()
   {
    $setting = new Settings();
    $setting->description = "Penalty Global Collection";
    $setting->option = 'penalty';
    $setting->value = Pentalty::where('paid',false)->pluck('received_amount')->sum();
    $setting->save();
    return $setting;
   }
   function updatePenaltySetting($value)
   {
        $setting = Settings::where('option','penalty')->first();
        if(!$setting)
        {
            $setting = $this->createPenaltySetting();
        }
        $setting->value = (int)$setting->value + $value;
        $setting->save();
   }

}
