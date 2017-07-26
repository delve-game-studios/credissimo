<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;
use App\Http\Requests\StoreUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadsController extends Controller
{
    private function checkIsAdmin() {
        if(!Auth::user()->is_admin) {
            redirect('/shop')->with('error', 'Access Denied!')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkIsAdmin();
        $uploads = Upload::all();
        return view('uploads.index', compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkIsAdmin();
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadRequest $request)
    {
        $this->checkIsAdmin();
        $data = $request->all();
        $data['title'] = '';
        $data['description'] = '';

        if(!is_array($request->file('file'))) {
            $files = [$request->file('file')];
        } else {
            $files = $request->file('file');
        }

        foreach($files as $file) {
            $filePath = $file->store(Auth::user()->id);

            $thumbnail = Image::make(Storage::get($filePath))->resize(256,256)->encode();
            $image = Image::make(Storage::get($filePath))->encode();

            $filePathA = explode('.', $filePath);
            $ext = array_pop($filePathA);
            $filename = array_shift($filePathA);

            Storage::disk('uploads')->put($filePath, $image);
            Storage::disk('uploads')->put("{$filename}.thumbnail.{$ext}", $thumbnail);

            $data['filename'] = str_replace(Auth::user()->id . '/', '', $filePath);
            $data['thumbnail'] = str_replace(Auth::user()->id . '/', '', "{$filename}.thumbnail.{$ext}");

            Upload::create($data);
        }

        return redirect()->route('uploads.index')->with(['message' => 'Upload successfull!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkIsAdmin();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->checkIsAdmin();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUploadRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUploadRequest $request, $id)
    {
        $this->checkIsAdmin();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $back = false)
    {
        $this->checkIsAdmin();
        $upload = Upload::findOrFail($id);
        Storage::disk('uploads')->delete(Auth::user()->id . "/{$upload->filename}");
        Storage::disk('uploads')->delete(Auth::user()->id . "/{$upload->thumbnail}");
        $upload->delete();

        return !$back ? redirect()->route('uploads.index')->with(['success' => 'File deleted successfully']) : true;
    }

    public function massDestroy(Request $request)
    {
        $this->checkIsAdmin();
        $uploads = explode(',', $request->input('ids'));
        foreach ($uploads as $upload_id) {
            $temp = $this->destroy($upload_id, true);
        }
        return redirect()->route('uploads.index')->with(['success' => 'Files deleted successfully']);
    }
}
