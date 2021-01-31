<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Victim;
use Illuminate\Support\Facades\Validator;
use App\Department;
use Illuminate\Validation\Rule;
use \FileUploader;
use App\File;


class VictimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $victims = Victim::whereHas('user', function($query){
            $query->where('id', Auth::user()->id);
        })->with('attachables')->get();

        return view('victim.index', compact('victims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('victim.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:victims', 'max:100'],
            'department_id' => ['required']
        ]);

        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $victim = new Victim();
        $victim->name = $request->name;
        $victim->age = $request->age;
        $victim->department_id = $request->department_id;
        $victim->user_id = Auth::id();
        $victim->save();

        if($request->files)
        {
            foreach($request->files as $file)
            {
                if($file)
                {
                    $data = explode('|', $file);
                    $file = new File;
                    $file->name = $data[0];
                    $file->mimetype = $data[1];
                    $file->path = "uploads";
                    $file->attachable_id = $victim->id;
                    $file->attachable_type = "App\Victim";
                }
            }
        }

        return redirect()->route('victim.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $victim = Victim::find($id);
        $departments = Department::all();

        return view('victim.edit', compact('victim','departments'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:victims,name,'.$id, 'max:100'],
            'department_id' => ['required']
        ]);

        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $victim = Victim::find($id);
        $victim->name = $request->name;
        $victim->age = $request->age;
        $victim->department_id = $request->department_id;
        $victim->user_id = Auth::id();
        $victim->save();

        return redirect()->route('victim.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {
        

        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 1,
            'fileMaxSize' => null,
            'disallowedExtensions' => ['htaccess', 'php', 'php3', 'php4', 'php5', 'phtml'],
            'uploadDir' => public_path('uploads/'),
            'title' => 'auto'
        ));

        // call to upload the files
        $data = $FileUploader->upload();

        // change file's public data
        if (!empty($data['files'])) {
            $item = $data['files'][0];
            
            $data['files'][0] = array(
                'title' => $item['title'],
                'name' => $item['name'],
                'size' => $item['size'],
                'size2' => $item['size2'],
                'type' => $item['type']
            );
        }

        // export to js
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;

    }

    public function remove(Request $request)
    {
        // dd($request->all());
        $file = public_path('uploads/') . str_replace(array('/', '\\'), '', $_POST['file']);
	
        if(file_exists($file)){
            unlink($file);
            echo 1;
        }

        
    }
}
