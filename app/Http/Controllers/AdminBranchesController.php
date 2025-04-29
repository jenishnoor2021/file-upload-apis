<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::get();

        return view('admin.branch.index', compact('branches'));
    }

    public function fetchAll()
    {
        $branches = Branch::get();

        $output = '';
        if ($branches->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead class="bg-primary">
              <tr>
                <th>Action</th>
                <th>Image</th>
                <th>Branch</th>
                <th>School Name</th>
                <th>Address</th>
                <th>Mobile no</th>
                <th>URL</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($branches as $br) {
                $output .= '<tr>
                <td>
                <a href="#" data-id="' . $br->id . '" class="btn editIcon" id="getEditButton"><i class="fa fa-edit" style="font-size:20px;"></i></a>
                <a href="/admin/branch/destroy/' . $br->id . '" class="text-danger mx-1 deleteIcon" onclick="return confirm(\'Sure ! You want to delete ?\');"><i class="fa fa-trash" style="font-size:20px;"></i></a>
                </td>
                <td><img src="' . $br->image . '" width="70" class="img-thumbnail rounded-circle"></td>
                <td>' . $br->branch . '</td>
                <td>' . $br->school_name . '</td>
                <td>' . $br->address . '</td>
                <td>' . $br->mobile . '</td>
                <td><a href="' . $br->website . '" target="_blank">' . $br->website . '</a></td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
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
        // $validatedData = $request->validate([
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        // ]);

        if ($file = $request->file('image')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('branchimg', $name);

            $imagename = "$name";

        }

        $branch = new Branch;

        $branch->school_name = $request->school_name;
        $branch->branch = $request->branch;
        $branch->address = $request->address;
        $branch->mobile = $request->mobile;
        $branch->website = $request->website;
        $branch->image = $imagename;

        $branch->save();

        $res['flag'] = 1;
        $res['msg'] = "successfully add data";
        return $res;
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
    public function edit(Request $request)
    {
        $branchdata = Branch::where('id', $request->id)->first();
        $res['data'] = $branchdata;
        $res['flag'] = 1;
        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($file = $request->file('image')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('branchimg', $name);

            $imagename = "$name";

            Branch::where('id', $request->id)->update(
                [
                    'image' => $imagename,
                ]);

        }

        Branch::where('id', $request->id)->update(
            [
                'school_name' => $request->school_name,
                'branch' => $request->branch,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'website' => $request->website,
            ]);

        $res['flag'] = 1;
        $res['msg'] = "Update  succesfully";
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Branch::findOrFail($id);
        // if ($image->file == '/branchimg/') {

        // } else {

        //     if (file_exists(public_path() . $image->file)) // make sure it exits inside the folder
        //     {
        //         unlink(public_path() . $image->file);
        //     }
        // }
        $image->delete();
        return Redirect::back();
    }
}
