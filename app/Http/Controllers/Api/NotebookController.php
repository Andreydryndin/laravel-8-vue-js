<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Notebook::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notebook = new Notebook();
        $notebook->name = $request->name;
        $notebook->company_name = $request->company_name;
        $notebook->telephone = $request->telephone;
        $notebook->email = $request->email;
        $notebook->birthday = $request->birthday;

        $notebook->photo = $request->photo;

        $notebook->save();

        return [
            "status" => true,
            "notebook" => $notebook
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notebook = Notebook::find($id);
        if (!$notebook) {
            return response()->json([
                "status" => false,
                "message" => "notebook not found"
            ])->setStatusCode(404);
        }
        return $notebook;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
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
        $notebook = Notebook::find($id);
        $notebook->name = $request->name;
        $notebook->company_name = $request->company_name;
        $notebook->telephone = $request->telephone;
        $notebook->email = $request->email;
        $notebook->birthday = $request->birthday;
        $notebook->photo = $request->photo;

        $notebook->save();

        return [
            "status" => true,
            "notebook" => $notebook
        ];
    }

    public function upload_screen(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

                $directory = 'images';
                $directoryPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory;
                $filename = '';
                do {
                    $filename = uniqid() . '.png';
                } while (file_exists($directoryPath . $filename));

                $file->move($directoryPath, $filename);

                // Resize maybe?
                //$img = Image::make($directoryPath . $filename);
                //$img->fit(120);
                //$img->save();
                $data['success'] = true;
                $data['filePath'] = $filename;
                return response()->json($data);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $notebook = Notebook::find($id);
        $notebook->delete();
    }
}
