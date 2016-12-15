<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portal;
use App\Document;
use Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $portal = Portal::find($id);

        return view('document.create', ['portal' => $portal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $portal_id = $request->portal_id;
        $portal = Portal::find($portal_id);
        $name = $request->name;
        $description = $request->description;

        $uploadDocument = $request->file('document');

        if ($uploadDocument->isValid()) {
            $path = $uploadDocument->storeAs('public/'.$portal_id, date('ymd').str_slug($name).'.pdf');

            $document = new Document;
            $document->name = $name;
            $document->location = date('ymd').str_slug($name).'.pdf';
            $document->description = $description;
            $document->user_id = $request->user_id;
            $document->portal_id = $portal_id;
            $document->save();
            return redirect()->route('portal.show', $portal->id)->with('message', $name.' uploaded to '.$portal->name);
        }else{
            return redirect()->back()->with('error', 'There was an error uploading the document.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        $portal = Portal::find($document->portal_id);

        return view('document.show', [
            'document' => $document,
            'portal' => $portal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $document = Document::find($id);

        if (Auth::user()) {
            if (Auth::user()->id == $document->user_id) {
                $portal = Portal::find($document->portal_id);

                return view('document.edit', [
                    'document' => $document,
                    'portal' => $portal
                ]);
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $document = Document::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $document->name = $request->name;
        $document->description = $request->description;

        $portal_id = $request->portal_id;
        $user_id = $request->user_id;
        $name = $request->name;
        $description = $request->description;

        if ($request->document != "") {
            $uploadDocument = $request->file('document');
            if ($uploadDocument->isValid()) {
                $path = $uploadDocument->storeAs('public/'.$portal_id, date('ymd').str_slug($name).'.pdf');

                $document = new Document;
                $document->name = $name;
                $document->location = date('ymd').str_slug($name).'.pdf';
                $document->description = $description;
                $document->user_id = $user_id;
                $document->portal_id = $portal_id;
                $document->save();
                return redirect()->route('document.show', $document->id)->with('message', 'Document edited successfully.');
            }else{
                return redirect()->back()->with('error', 'There was an error uploading the document.');
            }
        }else{
            $document->save();
            return redirect()->route('document.show', $document->id)->with('message', 'Document edited successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        $portal_id = $document->portal_id;
        $document->delete();

        return redirect()->route('portal.show', $portal_id)->with('message', 'Document deleted successfully.');
    }

    public function yours()
    {
        $documents = Document::where('user_id', Auth::user()->id)->get();

        return view('document.yours', ['documents' => $documents]);
    }
}
