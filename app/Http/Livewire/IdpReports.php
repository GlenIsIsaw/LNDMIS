<?php

namespace App\Http\Livewire;
use App\Models\Idp;
use Livewire\Component;
use Livewire\WithPagination;

class IdpReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $year;
    public $count = 0;
    public function render()
    {
        $this->dispatchBrowserEvent('toggle');
            $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status', 'idps.created_at As created_date')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('submit_status','Approved')
                ->where('idps.created_at', 'like', '%'.$this->year.'%')
                ->orderBy('idps.created_at','asc')
                ->paginate(3);
        
            //dd($lists->items());
            return view('livewire.idp-reports', [
            'idps' => $lists
        ]);
    }
}
