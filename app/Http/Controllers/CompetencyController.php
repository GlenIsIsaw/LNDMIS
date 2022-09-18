<?php

namespace App\Http\Controllers;

use App\Models\Competency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetencyController extends Controller
{
    public function empindex(){
        return view('employee.compindex');
    }
    public function index(){
        $list = DB::table('competencies')
                ->orderBy('competency_group','asc')
                ->get();

        $comp = $list->groupBy('competency_group')->toArray();
        foreach ($comp as $key => $value) {
            foreach ($value as $samp) {
                if($samp->teaching == 1 ){
                    $samp->teaching = "Yes";
                }else{
                    $samp->teaching = "No";
                }
                if($samp->nonteaching == 1 ){
                    $samp->nonteaching = "Yes";
                }else{
                    $samp->nonteaching = "No";
                }
            }
        }
        return view('competency.index',['comps' => $comp]);
    }
}
