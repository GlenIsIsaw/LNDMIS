<?php

namespace App\Http\Livewire\Idp;

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
    public $competency, $sug, $dev_act, $responsible, $support, $arrays, $name, $year, $mySignature, $supSignature, $filter_status;
    public $state;
    public $competencies = [];
    public $pageNum = 3;
    public $count = 0;

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
    public function tnm(){
        $this->countCompetency();
        $this->state = 'tnm';
    }
    public function backButton(){
        $this->state = null;
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
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->support as $item) {
                
                $arrays[$idp->name][$j]['submit_status'] = $idp->submit_status;
                $j++;
            }
        }
        $j = 0;
        foreach ($idps as $idp) {
    
            foreach ($idp->status as $item) {
                
                $arrays[$idp->name][$j]['status'] = $item;
                $j++;
            }
        }
        return $arrays;
    }
    public function countCompetency(){
        $comp = [];
        if ($this->filter_status) {
            $object = Idp::select('competency')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where('year',$this->year)
                ->where('submit_status', 'like', '%'.$this->filter_status.'%')
                ->orderBy('name','asc')
                ->get();
        } else {
                $object = Idp::select('competency')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where('year',$this->year)
                ->where(function($query) {
                    $query->where('submit_status', 'Approved')
                        ->orwhere('submit_status', 'Pending');
                })
                ->orderBy('name','asc')
                ->get();
        }
        
        
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

        $arr = [];
        foreach ($arrays as $name => $array) {
            foreach ($array as $key => $item) {
                if($item['competency'] != $this->competency){
                    array_push($arr, $temp[$name][$key]);
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
        $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status')
        ->join('users', 'users.id', '=', 'idps.user_id')
        ->where('college_id',auth()->user()->college_id)
        ->where('submit_status','Approved')
        ->orderBy('name','asc')
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
        $this->filter_status = null;
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
    public function xmlEntities($str)
    {
        $xml = array('&#8217;','&#8216;','&#96;','&#8245;','&#8242;','&#39;','&#92;','&#46;','&#41;','&#40;','&#8208;','&#47;','&#8211;','&#8212;','&#34;','&#38;','&#60;','&#62;','&#160;','&#161;','&#162;','&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;','&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;','&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;','&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;','&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;','&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;','&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;','&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;','&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;','&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;','&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;','&#251;','&#252;','&#253;','&#254;','&#255;');
        $html = array('&rsquo;','&lsquo;','&grave;','&bprime;','&prime;','&apos;','&bsol;','&period;','&rpar;','&lpar;','&hyphen;','&sol;','&ndash;','&mdash;','&quot;','&amp;','&lt;','&gt;','&nbsp;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;');
        $str = str_replace($html,$xml,$str);
        $str = str_ireplace($html,$xml,$str);
        return $str;
    }
    public function printall(){
        if ($this->filter_status) {
            $lists = Idp::select('user_id','name','competency','sug','dev_act','year','supervisor','college_name','coordinator')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('year',$this->year)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where('submit_status', 'like', '%'.$this->filter_status.'%')
                ->orderBy('name','asc')
                ->get();
        }else{
            $lists = Idp::select('user_id','name','competency','sug','dev_act','year','supervisor','college_name','coordinator')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('year',$this->year)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where(function($query) {
                    $query->where('submit_status', 'Approved')
                          ->orwhere('submit_status', 'Pending');
                })
                ->orderBy('name','asc')
                ->get();
        }

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

                "devact0#$i" => $this->xmlEntities(htmlentities($dev[0])),
                "devact1#$i" => $this->xmlEntities(htmlentities($dev[1])),
                "devact2#$i" => $this->xmlEntities(htmlentities($dev[2])),
                
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
    public function printTnmReports(){
        $competency = [];
        foreach ($this->competencies as $key => $value) {
            array_push($competency, ['competency' => $key, 'count' => $value]);
        }
        $this->competency = $competency[0]['competency'];
        //dd($this->competency);
        if ($this->filter_status) {
            $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status','submit_status')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('college_id',auth()->user()->college_id)
            ->where('submit_status', 'like', '%'.$this->filter_status.'%')
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->where('sug', 'like', '%'.$this->sug.'%')
            ->where('responsible', 'like', '%'.$this->responsible.'%')
            ->where('year', 'like', '%'.$this->year.'%')
            ->orderBy('name','asc')
            ->get();
        } else {
            $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status','submit_status')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('college_id',auth()->user()->college_id)
            ->where(function($query) {
                $query->where('submit_status', 'Approved')
                      ->orwhere('submit_status', 'Pending');
            })
            //->where('submit_status', 'like', '%'.$this->filter_status.'%')
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->where('sug', 'like', '%'.$this->sug.'%')
            ->where('responsible', 'like', '%'.$this->responsible.'%')
            ->where('year', 'like', '%'.$this->year.'%')
            ->orderBy('name','asc')
            ->get();
        } 
        $array = [];
        $array = $this->separate($lists);
        //dd($array);
        $arrays = $this->filterCompetency($array);
        //dd($arrays);
        $highest = [];
        foreach ($arrays as $name => $comp) {
            foreach ($comp as $key => $value) {
                array_push($highest,$value += ['name' => $name]);
            }
        }
        //dd($highest);
        $templateProcessor = new TemplateProcessor(storage_path('TNM-Reports.docx'));
        $college = College::select('college_name', 'supervisor')
            ->where('id',auth()->user()->college_id)
            ->first();
        $templateProcessor->setValue('college', $college->college_name);
        $templateProcessor->cloneRowAndSetValues('competency', $competency);
        $templateProcessor->setValue('sum', array_sum($this->competencies));
        //dd($highest);
        $templateProcessor->setValue('competency', $this->competency);
        foreach ($highest as $num => $value) {
            foreach ($value as $key => $item) {
                $highest[$num][$key] = $this->xmlEntities(htmlentities($item));
            }
        }
        $templateProcessor->cloneRowAndSetValues('name', $highest);

        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/TNMReports');
        $path = storage_path('app/public/users/'.auth()->user()->id.'/TNMReports/'.'TNMReports_'.$this->year.'.docx');
        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        $templateProcessor->saveAs($path);

        $this->competency = null;
        $this->dispatchBrowserEvent('close-modal');
        return response()->download($path)->deleteFileAfterSend(true);
        
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
    public function updatedFilterStatus($value){
        $this->resetPage();
    }
    public function mount(){
        $this->year = date('Y') + 1;
        $this->currentUrl = url()->current();
            //dd($this->currentUrl);
    }
    public function render()
    {
        $this->notification();
        $this->getInfo();
        $this->dispatchBrowserEvent('toggle');
            if ($this->filter_status) {
                $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status','submit_status')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('submit_status', 'like', '%'.$this->filter_status.'%')
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where('year', 'like', '%'.$this->year.'%')
                ->orderBy('name','asc')
                ->paginate(2);
            } else {
                $lists = Idp::select('idps.id As idp_id','name','competency','sug','dev_act','target_date','responsible','support','status','submit_status')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where(function($query) {
                    $query->where('submit_status', 'Approved')
                          ->orwhere('submit_status', 'Pending');
                })
                //->where('submit_status', 'like', '%'.$this->filter_status.'%')
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->where('sug', 'like', '%'.$this->sug.'%')
                ->where('responsible', 'like', '%'.$this->responsible.'%')
                ->where('year', 'like', '%'.$this->year.'%')
                ->orderBy('name','asc')
                ->paginate(2);
            } 
            $array = [];
           $array = $this->separate($lists->items());
            //dd($array);
            if($this->competency){
                $this->arrays = $this->filterCompetency($array);
            }
            else{
                $this->arrays = $this->separate($lists->items());
            }
            if($this->sug){
                $this->arrays = $this->filterSug($array);
            }
            if($this->responsible){
                $this->arrays = $this->filterResponsible($array);
            }
            
            //dd($this->arrays);
            return view('livewire.idp.idp-reports', [
            'idps' => $lists
        ]);
    }
}
