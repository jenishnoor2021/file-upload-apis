<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLinksController extends Controller
{

    public function showdata(Request $request, $name) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'code'     => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                400
            );
        }

        $get_data = Branch::where('code', $request->code)->first();

        if ($get_data) {
            return response()->json(
                [
                    'status' => 1,
                    'data' => $get_data,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 0,
                    'message' => 'data not found',
                ]
            );
        }
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

        $validator = Validator::make(
            $request->all(),
            [
                'image'     => 'required|file',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                400
            );
        }

        $number = substr(str_shuffle("0123456789"), 0, 5);

        if ($this->dimondCodeExists($number)) {
            $number = substr(str_shuffle("0123456789"), 0, 5);
        }

        $input = $request->all();
        if ($file = $request->file('image')) {
            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            if ($this->fileExistInFolder($str)) {
                // If the file exists, delete the old file and replace it with the new one
                unlink(public_path('branchimg/' . $str));
                $name = $str;
            } else {
                $name = $str;
            }

            // $name = time() . $str;

            $file->move('branchimg', $name);
            $imagename = "$name";
        } else {
            $imagename = '';
        }

        $input['code'] = $number;
        $input['image'] = 'http://127.0.0.1:8000/branchimg/' . $imagename;

        $existingBranch = Branch::where('image', 'http://127.0.0.1:8000/branchimg/' . $imagename)->first();

        if ($existingBranch) {
            $existingBranch->update($input);

            return response()->json(
                [
                    'status' => 1,
                    'data' => $existingBranch,
                    'message' => 'Existing file was replaced and record updated.',
                ],
                200
            );
        } else {
            // If no existing record with the same image, create a new record
            $client = Branch::create($input);

            if ($client) {
                return response()->json(
                    [
                        'status' => 1,
                        'data' => $client,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 0,
                        'message' => 'Data not found.',
                    ],
                    400
                );
            }
        }
    }

    public function dimondCodeExists($number)
    {
        return Branch::where('code', $number)->exists();
    }

    public function fileExistInFolder($filename)
    {
        return file_exists(public_path('branchimg/' . $filename));
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
        //
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
}
