<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;


class DocController extends Controller
{
    public function index(){
        $documents = Document::all();

        return view('documents.index', [
            'documents' => $documents
        ]);
    }
    public function create(){
        return View('documents.create');
    }
    public function store(Request $request){
        $document = new Document();
        $document->pname = request('pname');
        $document->page = request('page');
        $document->sage = request('sage');
        $document->section = request('section');
        $document->relation = request('relation');
        $document->dated = request('dated');
        $document->datem = request('datem');
        $document->pnum = request('pnum');
        $document->pemail = request('pemail');
        $document->sname = request('sname');
        $document->snum = request('snum');
        $document->semail = request('semail');


        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= request('sname').'signature';
            $file-> move(public_path('Image'), $filename);
            $document['signature']= $filename;
        }
        
        $document->save();
        return redirect('/view/document')->with('mssg', 'Updated') ;
    }

    public function show($id)
    {

        $document = DB::table('documents')->where('id', $id)->first();
        $array = [
            'pname' => $document->pname,
            'page' => $document->page,
            'sage' => $document->sage,
            'section' => $document->section,
            'relation' => $document->relation,
            'dated' => $document->dated,
            'datem' => $document->datem,
            'pnum' => $document->pnum,
            'pemail' => $document->pemail,
            'sname' => $document->sname,
            'snum' => $document->snum,
            'semail' => $document->semail
        ];

        $templateProcessor = new TemplateProcessor('Sample.docx');
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }


        $templateProcessor->setImageValue('signature', array('path' => $document->signature, 'width' => 100, 'height' => 50, 'ratio' => false));
        $templateProcessor->saveAs($document->sname.'.docx');
        return response()->download(public_path($document->sname.'.docx'))->deleteFileAfterSend(true);
    }
    public function printall(){
        $documentObject = Document::all();
        $documents = $documentObject->toArray();
        $templateProcessor = new TemplateProcessor('table.docx');
        $templateProcessor->cloneblock('table',0,true,false,$documents);
        $templateProcessor->saveAs('AllInfo.docx');
        return response()->download(public_path('AllInfo.docx'))->deleteFileAfterSend(true);
    }
}


