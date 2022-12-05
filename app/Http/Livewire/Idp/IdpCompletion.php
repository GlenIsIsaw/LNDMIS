<?php

namespace App\Http\Livewire\Idp;

use App\Models\Idp;
use App\Models\College;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use PhpOffice\PhpWord\TemplateProcessor;

class IdpCompletion extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $year, $name, $status, $competency;
    public $competencies = [];
    public $progress = [0=>"0%", 1=>"33.33%", 2=>"66.66%", 3=>"100%"];
    public $toggle, $currentUrl;
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
    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function getComp($lists){
        $array = [];
        $temp = [];

        foreach ($lists as $value) {
            array_push($temp, [$value->name => $value->competency]);
        }
        //$temp = $array->groupBy('name');
        foreach ($temp as $value) {
            foreach ($value as $key => $value) {
                $array[$key] = $value;
            }
        }

        //dd($array);
        return $array;
    }
    public function countTraining($array){
        $count = [];
        $tick = [];
        $j=0;
        foreach ($array as $key => $value) {
            $i = 0;
            foreach ($value as $item) {
                $lists = ListOfTraining::select('attendance_forms.competency As comp', 'list_of_trainings.status As stat', 'name')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('submit_status', 'Pending')
                ->where('list_of_trainings.status','Approved')
                ->where('list_of_trainings.date_covered', 'like', '%'.$this->year.'%')
                ->where('name', $key)
                ->where('attendance_forms.competency', 'like', '%'.$item.'%')
                ->orderBy('name','asc')
                ->count();
                //dd($lists);
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
    public function download(){
        $array = [];
        for ($i=0; $i < count($this->competencies); $i++) { 
            $array[$i]['name'] = $this->competencies[$i]['name'];
            $array[$i]['progress'] = $this->progress[$this->competencies[$i]['progress']];
            $j = 0;
            foreach ($this->competencies[$i]['competency'] as $key => $value) {
                $array[$i]["comp$j"] = $key;
                $array[$i]["count$j"] = $value;
                $j++;
            }
        }
        //dd($array);
        $templateProcessor = new TemplateProcessor(storage_path('IDP-Completion-Report.docx'));
        $college = College::select('college_name', 'supervisor')
            ->where('id',auth()->user()->college_id)
            ->first();
        $templateProcessor->setValue('college', $college->college_name);
        $templateProcessor->cloneRowAndSetValues('name', $array);
        

        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/IDP-Completion-Reports');
        $path = storage_path('app/public/users/'.auth()->user()->id.'/IDP-Completion-Reports/'.'IDP-Completion-Reports_'.$this->year.'.docx');
        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        $templateProcessor->saveAs($path);

        $this->competency = null;
        $this->dispatchBrowserEvent('close-modal');
        return response()->download($path)->deleteFileAfterSend(true);
    }
    public function resetFilter(){
        $this->name = null;
        $this->year = date('Y');
    }
    public function mount(){
        $this->year = date('Y');
        $this->currentUrl = url()->current();
            //dd($this->currentUrl);
    }
    public function render()
    {
        
        $this->notification();
        //$this->getInfo();
        $this->dispatchBrowserEvent('toggle');
        $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status','year')
        ->join('users', 'users.id', '=', 'idps.user_id')
        ->where('submit_status', 'Pending')
        ->where('college_id',auth()->user()->college_id)
        ->where('year', 'like', '%'.$this->year.'%')
        ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
        ->orderBy('name','asc')
        ->paginate(5);
        
        $arr = $this->getComp($lists->items());
        $this->countTraining($arr);
        return view('livewire.idp.idp-completion', ['idps' => $lists]);
    }
}
