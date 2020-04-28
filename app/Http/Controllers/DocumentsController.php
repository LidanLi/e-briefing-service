<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $this->authorize('manage', $document->trip);

        return view('trips.documents.edit', [
            'trip' => $document->trip,
            'document' => $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Document $document
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Document $document, Request $request)
    {
        $this->authorize('manage', $document->trip);

        $document->update([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'is_protected' => $request->has('is_protected')
        ]);

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->store('documents', 'public');

            $document->update([
                'file' => $filename
            ]);
        }

        return redirect()->route('trips.documents.index', $document->trip)->with('success', 'Document updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Document $document)
    {
        $this->authorize('manage', $document->trip);
        
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     * @internal param Request
     */
    public function destroyAll(Request $request)
    {
        
        $data = $request->all();
        $list = explode(',',$data['pass_checkedvalue']);
        
            if (!in_array(NULL, $list))
            {
                foreach ($list as $i => $id) {

                $document=Document::find($id);

                $document->delete();
                }

               return redirect()->back()->with('success', 'All documents removed'); 
            }
            else
            {
                return redirect()->back()->with('warning', 'No document selected');
            }
            
        
    }
}
