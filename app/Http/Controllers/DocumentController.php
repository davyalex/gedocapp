<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $documents = Document::with('media')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        // dd($documents->toarray());
        return view('pages.File.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'file' => 'required',
        ]);


        $document = Document::create([
            'title' => $request['title'],
            'category' => $request['category'],
            'user_id' =>  Auth::user()->id,

        ]);

        if (request()->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            // dd($extension);
            $document->addMediaFromRequest('file')->usingFileName($request['title'].'.'.$extension)->toMediaCollection('files');
        }

        return redirect()->route('document.index')->withSuccess('Document crée avec success');
    }

    public function downloadFile()
    {
        $path = request('path');
        $document_id = request('doc_id');

       
        // dd($nb);
        return response()->download($path);
    }

    //increment nb download without reload page
    public function incrementNbDownload($id)
    {
        $document = Document::find($id);
        $increase =  $document->increment('nb_download');
        $document = Document::get();

        
        return response()->json($document);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // $document = Document::findOrfail($id)->with('media')->first();
        // // dd($document->toArray());
        // return  view('pages.File.index', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'file' => '',
        ]);

        $document = tap(Document::findOrFail($id))->update([
            'title' => $request['title'],
            'category' => $request['category'],
        ]);


        //upload new file
        if ($request->has('file')) {
            $document->clearMediaCollection('files');
            $extension = $request->file->getClientOriginalExtension();
            $document->addMediaFromRequest('file')->usingFileName($request['title'].'.'.$extension)->toMediaCollection('files');
        }

        return redirect()->route('document.index')->withSuccess('Document modifié avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Document::findOrFail($id)->delete();
        return response()->json([
            'message' => 'suppression reussi',
            'status' => 200

        ]);
    }
}
