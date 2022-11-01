<?php

namespace App\Http\Livewire;

use App\Models\College;
use App\Models\Idp;
use App\Models\User;
use Livewire\Component;
use App\Models\Competency;
use Livewire\WithPagination;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class IdpReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $Idp;
    public $competency, $sug, $dev_act, $responsible, $support, $arrays, $name, $year, $mySignature, $supSignature;
    public $competencies = [];
    public $pageNum = 3;
    public $count = 0;


    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function separate($idps){
        $arrays = array();
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->competency as $item) {
                
                $arrays[$idp->name][$j]['competency'] = $item;
                $j++;
            }
            
        }
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->sug as $item) {
                
                $arrays[$idp->name][$j]['sug'] = $item;
                $j++;
            }
            
        }
        
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->dev_act as $item) {
                
                $arrays[$idp->name][$j]['dev_act'] = $item;
                $j++;
            }
            
        }
    
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->target_date as $item) {
                
                $arrays[$idp->name][$j]['target_date'] = $item;
                $j++;
            }
            
        }
        
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->responsible as $item) {
                
                $arrays[$idp->name][$j]['responsible'] = $item;
                $j++;
            }
            
        }
        
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->support as $item) {
                
                $arrays[$idp->name][$j]['support'] = $item;
                $j++;
            }
        }

        return $arrays;
    }
    public function countCompetency(){
        $comp = [];
        $object = Idp::select('competency')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('college_id',auth()->user()->college_id)
            ->where('name', 'like', '%'.$this->name.'%')
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->where('sug', 'like', '%'.$this->sug.'%')
            ->where('responsible', 'like', '%'.$this->responsible.'%')
            ->where('year',$this->year)
            ->where('submit_status','Approved')
            ->orderBy('idps.created_at','asc')
            ->get();
        $lists = $object->toArray();
        $i = 0;
        foreach ($lists as $name => $list) {

            foreach ($list as $key => $num) {
                foreach ($num as $item) {
                    $comp[$i] = $item;
                    $i++;
                }

            }
        }
        $this->competencies = array_count_values($comp);
        arsort($this->competencies);
    }
    public function filterSug($arrays){
        $temp = $arrays;
        foreach ($arrays as $name => $array) {
            foreach ($array as $key => $item) {
                if($item['sug'] != $this->sug){
                    unset($temp[$name][$key]);
                }
            }
        }
        return $temp;
    }
    public function filterCompetency($arrays){
        $temp = $arrays;
        foreach ($arrays as $name => $array) {
            foreach ($array as $key => $item) {
                if($item['competency'] != $this->competency){
                    unset($temp[$name][$key]);
                }
            }
        }
        return $temp;
    }
    public function filterResponsible($arrays){
        $temp = $arrays;
        foreach ($arrays as $name => $array) {
            foreach ($array as $key => $item) {
                if($item['responsible'] != $this->responsible){
                    unset($temp[$name][$key]);
                }
            }
        }
        return $temp;
    }
    public function getInfo(){
        $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status', 'idps.created_at As created_date')
        ->join('users', 'users.id', '=', 'idps.user_id')
        ->where('college_id',auth()->user()->college_id)
        ->where('submit_status','Approved')
        ->orderBy('idps.created_at','asc')
        ->get();

        $this->Idp = $lists;
    }
    public function resetFilter(){
        $this->year = date('Y') + 1;
        $this->competency = null;
        $this->sug = null;
        //$this->target_date = null;
        //$this->dev_act = null;
        $this->responsible = null;
        $this->support = null;
        $this->name = null;
        //$this->pageNum = 3;
        $this->count = 0;
    }
    public function printFormat($idps){
        $arrays = array();
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->competency as $item) {
                
                $arrays[$idp->name][$j]['competency'] = $item;
                $arrays[$idp->name][$j]['year'] = $idp->year;
                $j++;
            }
            
        }
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->sug as $item) {
                
                $arrays[$idp->name][$j]['sug'] = $item;
                $arrays[$idp->name][$j]['year'] = $idp->year;
                $j++;
            }
            
        }
        
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->dev_act as $item) {
                
                $arrays[$idp->name][$j]['dev_act'] = $item;
                $arrays[$idp->name][$j]['year'] = $idp->year;
                $j++;
            }
            
        }
        return $arrays;
    }
    public function printall(){
        $lists = Idp::select('user_id','name','competency','sug','dev_act','year','supervisor','college_name','coordinator')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->join('colleges', 'colleges.id', '=', 'users.college_id')
            ->where('college_id',auth()->user()->college_id)
            ->where('year',$this->year)
            ->where('name', 'like', '%'.$this->name.'%')
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->where('sug', 'like', '%'.$this->sug.'%')
            ->where('responsible', 'like', '%'.$this->responsible.'%')
            ->where('submit_status','Approved')
            ->orderBy('idps.created_at','asc')
            ->get();
        if(!$lists->isEmpty()){
        //dd($lists);
        //dd($list);
        $list = $this->printFormat($lists);
        $college = College::select('college_name', 'supervisor')
                        ->where('id',auth()->user()->college_id)
                        ->first();
        //dd($list);
        $templateProcessor = new TemplateProcessor(storage_path('Local-Learning-Development-Plan.docx'));
        $templateProcessor->setValue("college", $college->college_name);
        $templateProcessor->setValue("year", $this->year);
        $templateProcessor->cloneRow('ename', count($list));
        $i = 1;
        foreach($list as $name => $group) 
        {
            $j = 0;
            $comp = [];
            $dev = [];
            $sug = [];
            $year = '';
            $templateProcessor->setValue("ename#$i", $name);
            foreach($group as $row) 
            {

                $comp[$j] = $row['competency'];
                $dev[$j] = $row['dev_act'];
                $sug[$j] = $row['sug'];
                $year = $row['year'];
                $j++;
            }
            $templateProcessor->setValues(array(
                "compe0#$i" => $comp[0],
                "compe1#$i" => $comp[1],
                "compe2#$i" => $comp[2],

                "devact0#$i" => $dev[0],
                "devact1#$i" => $dev[1],
                "devact2#$i" => $dev[2],
                
                "year#$i" => $year,
            ));
            for ($x=0; $x < count($sug); $x++) { 
                if ($sug[$x] == 'S') {
                    $templateProcessor->setValue("s$x#$i", '/');
                    $templateProcessor->setValue("u$x#$i", ' ');
                    $templateProcessor->setValue("g$x#$i", ' ');
                } elseif ($sug[$x] == 'U') {
                    $templateProcessor->setValue("u$x#$i", '/');
                    $templateProcessor->setValue("s$x#$i", ' ');
                    $templateProcessor->setValue("g$x#$i", ' ');
                }elseif ($sug[$x] == 'G') {
                    $templateProcessor->setValue("g$x#$i", '/');
                    $templateProcessor->setValue("s$x#$i", ' ');
                    $templateProcessor->setValue("u$x#$i", ' ');
                }
            }
            $i++;
        }
        $this->countCompetency();
        $table = new Table(array('borderSize' => 5, 'borderColor' => 'black','unit' => TblWidth::TWIP, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $styleHeader = array('bgcolor' => '#800000', 'valign' => 'center');
        $styleFooter = array('bgcolor' => '#0000FF', 'valign' => 'center');
        $fontheader = array('bold' => true, 'align' => 'center', 'color' => '#FFFFFF');
        $font = array('align' => 'center');
        $table->addRow();
        $table->addCell(5000, $styleHeader)->addText('Target Competency',$fontheader);
        $table->addCell(250, $styleHeader)->addText('Count',$fontheader);
        foreach ($this->competencies as $comp => $count) {
            $table->addRow();
            $table->addCell(5000)->addText($comp, $font);
            $table->addCell(500)->addText($count, $font);
        }
        $table->addRow();
        $table->addCell(5000, $styleFooter)->addText('Total',$fontheader);
        $table->addCell(500, $styleFooter)->addText(array_sum($this->competencies),$fontheader);
        $templateProcessor->setComplexBlock('table', $table);


        $supervisor = User::select('name', 'signature')
            ->join('colleges', 'colleges.id', '=', 'users.college_id')
            ->where('users.id','=',$college->supervisor)
            ->first();
        //dd($supervisor);
        if($this->mySignature == '1'){
            if(auth()->user()->signature){
                $templateProcessor->setImageValue('coorsign', array('path' => public_path('storage/users/'.auth()->user()->id.'/'.auth()->user()->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
            }else{
                session()->flash('message','You have no signature');
                $templateProcessor->setValue('coorsign'," ");
            }
            
        }else{
            $templateProcessor->setValue('coorsign'," ");
        }
        if($this->supSignature == '1'){
            if ($supervisor->signature) {
                $templateProcessor->setImageValue('ssign', array('path' => public_path('storage/users/'.$college->supervisor.'/'.$supervisor->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
            }else {
                session()->flash('message','The Supervisor has no signature');
                $templateProcessor->setValue('ssign'," ");
            }
            
        }else{
            $templateProcessor->setValue('ssign'," ");
        }

        $templateProcessor->setValue('coorname',auth()->user()->name);
        $templateProcessor->setValue('sname',$supervisor->name);
        $this->dispatchBrowserEvent('close-modal');
        $path = 'app/public/users/'.auth()->user()->id.'/Local-Learning-Development-Plan_'.$year.'.docx';
        $templateProcessor->saveAs(storage_path($path));
        return response()->download(storage_path($path))->deleteFileAfterSend(true);
        
        $this->resetInput();
        $this->resetFilter();
        }else {
            session()->flash('message','The table is Empty');
            $this->dispatchBrowserEvent('close-modal');
            $this->resetInput();
            $this->resetFilter();
        }
    }
    public function resetInput(){
        $this->competencies = null;
        $this->mySignature = null;
        $this->supSignature = null;
    }
    
    public function updatedSug($value){
        $this->resetPage();
    }
    public function updatedName($value){
        $this->resetPage();
    }
    public function updatedCompetency($value){
        $this->resetPage();
    }
    public function updatedResponsible($value){
        $this->resetPage();
    }
    public function updatedYear($value){
        $this->resetPage();
    }
    public function mount(){
        $this->year = date('Y') + 1;
    }
    public function render()
    {
        $this->notification();
        $this->getInfo();
        $this->dispatchBrowserEvent('toggle');
            $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status', 'idps.created_at As created_date')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('submit_status','Approved')
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where('year', 'like', '%'.$this->year.'%')
                ->orderBy('idps.created_at','asc')
                ->paginate(3);

            if($this->competency){
                $this->arrays = $this->filterCompetency($this->separate($lists->items()));
            }
            else{
                $this->arrays = $this->separate($lists->items());
            }
            if($this->sug){
                $this->arrays = $this->filterSug($this->arrays);
            }
            if($this->responsible){
                $this->arrays = $this->filterResponsible($this->arrays);
            }
            
            //dd($this->arrays);
            return view('livewire.idp-reports', [
            'idps' => $lists
        ]);
    }
}
