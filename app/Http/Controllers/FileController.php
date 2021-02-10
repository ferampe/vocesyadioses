<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\File;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
        
        $mimeImage = ['image/jpeg', 'image/png', 'image/jpg'];

        if(in_array($request->file('file')->getMimeType(), $mimeImage))
        {
            $ramdon = Str::random(10);

            $name = $ramdon . $request->file('file')->getClientOriginalName();
            $nameThumb = "thumb_" . $ramdon . $request->file('file')->getClientOriginalName();

            $pathNormal = storage_path()."/app/public/" . $name;
            $pathThumb = storage_path()."/app/public/" . $nameThumb;

            Image::make($request->file('file'))
                ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathNormal);

            Image::make($request->file('file'))
                ->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathThumb);

            File::create([
                'user_id' => Auth::user()->id,
                'name' => $name,
                'url' => '/storage\/' . $name,
                'thumbnail' => '/storage\/' . $nameThumb,
                'mimetype' => $request->file('file')->getMimeType()
            ]);
        }else{

            // $name = Str::random(10) . $request->file('file')->getClientOriginalName();

            $imagenes = $request->file('file')->store('public');

            $name = explode('/', $imagenes);

            $url = Storage::url($imagenes);

            File::create([
                'user_id' => Auth::user()->id,
                'name' => $name[1],
                'url' => $url,
                'mimetype' => $request->file('file')->getMimeType()
            ]);

        }
        

        return redirect()->route('home');
    }

    public function delete($fileId)
    {

        $file = File::find($fileId);

        $image_path = storage_path()."/app/public/".$file->name;

        if (file_exists($image_path)) {
            // dd('ingrese');
            if($file->mimetype == 'image/jpeg' || $file->mimetype == 'image/jpg' || $file->mimetype == 'image/png')
            {
                @unlink($image_path);
                @unlink("thumb_" . $image_path);
            }

            if($file->mimetype == 'audio/mpeg' || $file->mimetype == 'video/mp4')
            {
                @unlink($image_path);
            }
     
        }

        $file->delete();

        // dd($file);

        return redirect()->route('home');
    }
}
