<?php

namespace App\Http\Livewire;
use App\Models\Idp;
use Livewire\Component;
use App\Models\Competency;
use Livewire\WithPagination;

class IdpReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $Idp;
    public $competency, $sug, $target_date, $dev_act, $responsible, $support, $arrays, $name;
    public $pageNum = 3;
    public $count = 0;
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
            
            //dd($array);
            return view('livewire.idp-reports', [
            'idps' => $lists
        ]);
    }
}
