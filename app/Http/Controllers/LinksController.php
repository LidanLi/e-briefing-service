<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        $this->authorize('manage', $link->trip);

        return view('trips.links.edit', [
            'trip' => $link->trip,
            'link' => $link
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
    public function update(Link $link, Request $request)
    {
        $this->authorize('manage', $link->trip);

        $link->update([
            'name' => $request->name,
            'link_type' => $request->link_type,
            'linkinfo' => $request->linkinfo
        ]);

        
        return redirect()->route('trips.links.index', $link->trip)->with('success', 'Link updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Link $link)
    {
        $this->authorize('manage', $link->trip);
        
        $link->delete();

        return redirect()->back()->with('success', 'Link deleted');
    }
}
