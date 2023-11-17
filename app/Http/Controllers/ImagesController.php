<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use Auth;
use Redirect;
use Str;

class ImagesController extends Controller
{
    public function index_slideshow()
    {
        $data['images'] = Images::where('jenis', 'slideshow')->orderBy('id', 'DESC')->get();
        return view('backend.auth.admin.index_slideshow', $data);
    }
    public function store_slideshow(Request $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path('/storage/slideshow');
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $path = '/storage/slideshow/' . $fileName;
            $evidence = new Images();
            $evidence->uuid =  Str::uuid()->toString();
            $evidence->jenis = 'slideshow';
            $evidence->alt = $file->getClientOriginalName();
            $evidence->path = $path;
            $evidence->status = 1;
            $evidence->upload_by = auth()->user()->name;
            $evidence->save();
            return Redirect::back()->withFlashSuccess(__('Slideshow berhasil diunggah.'));
        }
        return redirect()->back()->with('error', 'Tidak ada gambar yang diunggah.');
    }
    public function destroy_slideshow($id)
    {
        $image = Images::findOrFail($id);
        $image->delete();

        return response()->json(null, 204);
    }
    public function status_slideshow($id)
    {
        $image = Images::findOrFail($id);
        $image->status = $image->status == 1 ? 0 : 1;
        $image->save();

        return response()->json(['status' => $image->status]);
    }

    public function index_gallery()
    {
        $data['images'] = Images::where('jenis', 'gallery')->orderBy('id', 'DESC')->get();
        // return response()->json($images);
    }
}
