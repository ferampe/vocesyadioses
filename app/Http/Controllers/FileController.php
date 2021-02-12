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

            /**
             * Validar si hay mas de 3 imagenes
             */
            $files = File::where('user_id', Auth::user()->id)->get();

            $grouped = $files->groupBy('mimetype')->all();

            if(isset($grouped['image/jpeg']))
            {
                if( count($grouped['image/jpeg']) >= 3 )
                {
                    return redirect()->back()->with('has_3_images', 'Solo se pueden subir 3 imagenes, puede eliminar imagenes para subir otras');
                }
            }

         

            // if( array_key_exists($request->file('file')->getMimeType(), $grouped) )
            // {
            //     return redirect()->back()->with('has_video', 'Ya existe un video, puede eliminar y subir otro video');
            // }

            // if( array_key_exists($request->file('file')->getMimeType(), $grouped) )
            // {
            //     return redirect()->back()->with('has_audio', 'Ya existe un audio, puede eliminar y subir otro video');
            // }

            /** */


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

            /**
             * Validar si a existe video o audio
             */
            $files = File::where('user_id', Auth::user()->id)->get();

            $grouped = $files->groupBy('mimetype')->all();

            if( array_key_exists($request->file('file')->getMimeType(), $grouped) )
            {
                return redirect()->back()->with('has_video', 'Ya existe un video, puede eliminar y subir otro video');
            }

            if( array_key_exists($request->file('file')->getMimeType(), $grouped) )
            {
                return redirect()->back()->with('has_audio', 'Ya existe un audio, puede eliminar y subir otro video');
            }

            /** */

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
