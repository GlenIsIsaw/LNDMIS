<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Idp;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use App\Models\IncomingTrainings;

class Dashboard extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $name, $year, $date, $file, $toggle, $currentUrl, $fileType, $start_date, $end_date, $invitation_id, $sponsor, $venue, $level, $level_others, $free, $amount, $date_covered;
    public $filter_name, $filter_level, $filter_free;
    public $competencies = [];
    public $progress = [0=>"0%", 1=>"33.33%", 2=>"66.66%", 3=>"100%"];
    //public $currentUrl, $toggle;

    protected $listeners = [
        'toggle' => 'open'
    ];
    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
    public function mount(){
        $this->currentUrl = url()->current();
        //dd($this->currentUrl);
    }

    public function getComp(){
        $array = [];
        $temp = [];
        $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status','year')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('year', 'like', '%'.date('Y').'%')
                ->where('user_id', auth()->user()->id)
                //->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->orderBy('name','asc')
                ->get();
        foreach ($lists as $value) {
            array_push($temp, [$value->name => $value->competency]);
        }
        //$temp = $array->groupBy('name');
        foreach ($temp as $value) {
            foreach ($value as $key => $value) {
                $array[$key] = $value;
            }
        }


        return $array;
    }
    public function countTraining(){
        $count = [];
        $tick = [];
        $array = $this->getComp();
        $j=0;
        foreach ($array as $key => $value) {
            $i = 0;
            foreach ($value as $item) {
                $lists = ListOfTraining::join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('list_of_trainings.status','Approved')
                ->where('name', $key)
                ->where('attendance_forms.competency', 'like', '%'.$item.'%')
                ->orderBy('name','asc')
                ->count();
                $count[$j]['competency'][$item] = $lists;
                if($lists){
                    $i++;   
                }
                
            }
            $count[$j]['progress'] = $i;
            $count[$j]['name'] = $key;
            $j++;
        }
        //dd($count);
        $this->competencies = $count;
    }
    public function fileType($filename){
        $array = explode(".", $filename);
        return strtolower(end($array));

    }
    public function show(int $id){
        $lists = IncomingTrainings::where('college_id',auth()->user()->college_id)
                ->where('id', $id)
                ->first();

        
        $this->fileType = $this->fileType($lists->file);
        $this->name = $lists->name;
        $this->date = $lists->date;
        $this->file = $lists->file;
        $this->sponsor = $lists->sponsor;
        $this->venue = $lists->venue;
        $this->level = $lists->level;
        $this->date_covered = $lists->date_covered;
        $this->free = $lists->free;
        $this->amount = $lists->amount;
        
        //dd($this->fileType);

    }
    public function resetFilter(){
        $this->filter_name = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->filter_level = null;
        $this->filter_free = null;

    }
    public function render()
    {
        $this->countTraining();
        //dd($this->getComp());
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = IncomingTrainings::where('college_id', auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('free', 'like', '%'.$this->filter_free.'%')
                ->where('date','>',date('Y-m-d'))
                ->whereBetween('date',[$start_date,$end_date])
                ->orderBy('updated_at')
                ->paginate(3);
        }else{
            $lists = IncomingTrainings::where('college_id', auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
            ->where('level', 'like', '%'.$this->filter_level.'%')
            ->where('free', 'like', '%'.$this->filter_free.'%')
            ->where('date','>',date('Y-m-d'))
            ->orderBy('updated_at')
            ->paginate(3);
        }
        return view('livewire.dashboard', ['trainings' => $lists]);
    }
} 
