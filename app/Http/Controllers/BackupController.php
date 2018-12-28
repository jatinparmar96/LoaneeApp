<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanRecord;
use App\LoanUser;
use App\Pentalty;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Agent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function createBackup()
    {
        set_time_limit(0);
        $loan_users = LoanUser::all();
        $loans = Loan::all();
        $loanRecords = LoanRecord::all();
        $penalties = Pentalty::all();
        $agents = Agent::all();
        $users = User::all();
        $backup = array(
          'loan_users'=>$loan_users,
          'loans'=>$loans,
          'loanRecords'=>$loanRecords,
          'penalties'=>$penalties,
          'agents'=>$agents,
          'users'=>$users
        );
        file_put_contents('Backup\backup.json',json_encode($backup));
        return response()->download('Backup\backup.json','BackupFile.json');
    }
    public  function RestoreView()
    {
      return view('Restore.restore');
    }
    
    public function Restore(Request $request)
    {
        set_time_limit(0);
        $backup = file_get_contents($request->backup_file);
        $backup = json_decode($backup,true);
        $users = collect($backup['users']);
        $loan_users = collect($backup['loan_users']);
        $loans = collect($backup['loans']);
        $loanRecords = collect($backup['loanRecords']);
        $penalties = collect($backup['penalties']);
        $agents = collect($backup['agents']);
        Artisan::call('migrate:refresh');
        
       $this->insertIntoDB($loanRecords,'loan_records');
       $this->insertIntoDB($users,'users');
       $this->insertIntoDB($loans,'loans');
       $this->insertIntoDB($penalties,'pentalties');
       $this->insertIntoDB($agents,'agents');
       $this->insertIntoDB($loan_users,'loan_users');
   
        Auth::logout();
        return redirect()->route('login');
    }

    private static function insertIntoDB($collection,$table)
     {
      $chunks = $collection->chunk(500);
      foreach($chunks as $chunk)
      {
        DB::table($table)->insert($chunk->toArray());
      }
     
    }
}
