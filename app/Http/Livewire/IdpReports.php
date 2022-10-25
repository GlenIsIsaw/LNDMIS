<?php

namespace App\Http\Livewire;
use App\Models\Idp;
use Livewire\Component;
use Livewire\WithPagination;

class IdpReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $year, $competency, $sug, $target_date, $dev_act, $responsible, $support, $arrays, $name;
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
    public function updatedSug($value){
        $this->pageNum = 10;
        $this->resetPage();
    }
    public function updatedName($value){
        $this->resetPage();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('toggle');
            $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status', 'idps.created_at As created_date')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('submit_status','Approved')
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('idps.created_at', 'like', '%'.$this->year.'%')
                ->orderBy('idps.created_at','asc')
                ->paginate($this->pageNum);
            if($this->sug){
                $this->arrays = $this->filterSug($this->separate($lists->items()));
            }
            else{
                $this->arrays = $this->separate($lists->items());
            }
            
            //dd($array);
            return view('livewire.idp-reports', [
            'idps' => $lists
        ]);
    }
}
