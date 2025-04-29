@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Branch List
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Branch List</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="box-header">
                  <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
               </div>
               <div class="row">
                  <div class="col-md-9">
                  <button type="button" class="btn btn-primary" style="padding:12px 12px;margin-left:20px" data-toggle="modal" data-target="#add_branch_modal"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></button>

                  </div>
                  <div class="col-md-3">

                  </div>
               </div>
               <!-- /.box-header -->
               <div class="box-body" style="overflow-x:auto;margin-top:15px">

                  <!-- <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Action</th>
                           <th>Name</th>
                           <th>Image</th>
                           <th>mobile</th>
                           <th>url</th>
                        </tr>
                     </thead>
                     <tbody>

                     @foreach ($branches as $da)
                     <tr>
                          <td><button data-id="{{$da->id}}" id="getEditButton"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:#0275d8;padding:8px;border-radius:200px;"></i></button>
                           <a href="/admin/branch/destroy/{{$da->id}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:red;padding:8px;border-radius:200px;"></i></a></td>
                           <td>{{$da->name}}</td>
                           <td><img height="50" src="{{$da->image}}" alt=""></td>
                        </tr>
                     @endforeach
                     </tbody>
                  </table> -->

                  <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>

               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

<!-- add branch Modal -->

<div class="modal fade" id="add_branch_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Branch</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <form id="branchForm" action="javascript:void(0)" name="addbranch" role="form" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="md-form mb-4">
                <label for="image" class="text-dark"><h5>Branch image</h5></label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <!-- <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;"> -->
               <img id="blah" src="#" alt="your image" style="display:none;max-height: 250px;" />

            <div class="md-form mb-4">
               <label for="name" class="text-dark"><h5>Branch name</h5></label>
               <input type="text" name="name" class="form-control">
            </div>


      </div>
      <div class="modal-footer d-flex justify-content-center">

         <button type="submit" class="btn btn-success" id="submit">Submit</button>

      </form>

      </div>
    </div>
  </div>
</div>


<!-- edit branch Modal -->

<div class="modal fade" id="branch_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Branch</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <form id="editbranchForm" name="editbranch" role="form" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="id" name="id" value="">

            <div class="md-form mb-4">
                <label for="image" class="text-dark"><h5>Branch image</h5></label>
                <input type="file" id="image_edit" name="image" class="form-control">
            </div>
            <img id="blah_edit" src="#" alt="your image" style="display:none;max-height: 250px;" />
            <div class="mt-2" id="avatar"></div>

            <div class="md-form mb-5">
                <label for="name" class="text-dark"><h5>Enter Branch Name</h5></label>
                <input type="text" id="name" value="" name="name" class="form-control">
            </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">

      <button type="submit" class="btn btn-success" id="update">Update</button>
      </form>

      </div>
    </div>
  </div>
</div>

@endsection
