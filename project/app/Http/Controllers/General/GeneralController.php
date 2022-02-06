<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class GeneralController extends Controller{
    public function index() {
        $projects= DB::table('projects')->get();
        return view('index',compact('projects'));
    }
    public function ownProjectIndex(){
        $projects= DB::table('projects')->get();
        return view('own_project',compact('projects'));
    }

    public function InvestorsIndex($id){
        $projects_investors= DB::table('projects_investors')->where("idProject",'=',$id)->get();
        $project= DB::table('projects')->where("idProject",'=',$id)->first();
        return view('investors_index',compact('projects_investors','project'));
    }

    public function calcFund($id){
        return DB::table('projects_investors')->where('idProject','=',$id)->sum('investmentFund');
    }
    public function getProject(Request $request){
        $project = DB::table('projects')->where('idProject','=',$request->id)->get();
        if ($project) {
            return $project;
        }
        return 0;
    }
    public function Invest(Request $request){
        $request->validate([
            'money' => 'required|min:1',
        ]);

        if(DB::table('projects')->where('idProject','=',$request->id_project)->exists() &&
            DB::table('projects_investors')->where('idProject','=',$request->id_project)->where("idUser","=",session('user')->idUser)->doesntExist() &&
            DB::table('projects')->where('idProject','=',$request->id_project)->where("idUser","=",session('user')->idUser)->doesntExist()){


            $requestedFund=DB::table('projects')->where('idProject','=',$request->id_project)->value("requestedFund");
            $endDate=DB::table('projects')->where('idProject','=',$request->id_project)->value("projectEndDate");

            $sumFund=$this->calcFund( $request->id_project);
            $expected=$requestedFund-$sumFund;
            $cDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($cDate));
            $startDate=DB::table('projects')->where('idProject','=',$request->id_project)->value("projectStartDate");

            if($request->money <= $expected && $currentDate<$endDate && $startDate<$currentDate){
                $data = DB::table('projects_investors')->insertOrIgnore([
                    'idUser' =>session('user')->idUser,
                    'idProject' => $request->id_project,
                    "investmentFund"=>$request->money,
                    "investmentDate"=>$currentDate,
                ]);
                if($data){
                    return redirect()->back()->with('success', true);
                }
                else{
                    return redirect()->back()->with('error', true);
                }
            }
            else if($request->money > $expected){
                return redirect()->back()->with('error_money', $expected);
            }
            else if ($currentDate>$endDate ){
                return redirect()->back()->with('error_date', true);
            }
            else{
                return redirect()->back()->with('error_start', true);

            }
        }else{
            return redirect()->back()->with('error', true);
        }

    }
}


