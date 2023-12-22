<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home(){
        $documents = Document::with('media')->orderBy('created_at', 'DESC')->get();
        // dd($documents->toArray());   
        return view('home', compact('documents'));
    }

//recuperer les document lié à la categorie
    public function getDocumentOfCategory(){
        try {
            $category = request('category');

        $documents = Document::with('media')
        ->when($category=='bilan', fn($q)=>$q->whereCategory('bilan'))
        ->when($category=='rapport', fn($q)=>$q->whereCategory('rapport'))
        ->when($category=='note analyse', fn($q)=>$q->whereCategory('note_analyse'))
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('home', compact('documents'));
            

        } catch (\Throwable $th) {
            return redirect()->action([HomeController::class, 'home']);
           
        }
       
        
        


    }
}
