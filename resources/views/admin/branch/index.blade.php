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

                  <div class="card-body" id="show_all_branches">
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
      <div class="modal-header text-center bg-primary">
        <h3 class="modal-title font-weight-bolder">Add Branch
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size:30px;">&times;</span>
        </button>
        </h3>
      </div>
      <div class="modal-body mx-3">

        <form id="branchForm" action="javascript:void(0)" name="addbranch" role="form" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="md-form mb-4">
               <label for="school_name"><h5>School name <span>*</span></h5></label>
               <input type="text" name="school_name" class="form-control" placeholder="Enter school name">
            </div>

            <div class="md-form mb-4">
               <label for="branch"><h5>Branch name <span>*</span></h5></label>
               <input type="text" name="branch" class="form-control" placeholder="Enter branch name">
            </div>

            <div class="md-form mb-4">
               <label for="address"><h5>Branch Address <span>*</span></h5></label>
               <textarea type="text" name="address" rows="2" class="form-control" placeholder="Enter branch address"></textarea>
            </div>

            <div class="md-form mb-4">
               <label for="mobile"><h5>Conatct no <span>*</span></h5></label>
               <input type="text" name="mobile" class="form-control" placeholder="Enter contact number">
            </div>

            <div class="md-form mb-4">
               <label for="website"><h5>Website url <span>*</span></h5></label>
               <input type="text" name="website" class="form-control" placeholder="Enter website url">
            </div>

            <div class="md-form mb-4">
                <label for="image"><h5>Branch image <span>*</span></h5></label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <img id="blah" src="#" alt="your image" style="display:none;max-height: 250px;" />


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
      <div class="modal-header text-center bg-primary">
        <h3 class="modal-title font-weight-bolder">Edit Branch
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size:30px;">&times;</span>
        </button>
        </h3>
      </div>
      <div class="modal-body mx-3">

        <form id="editbranchForm" name="editbranch" role="form" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="id" name="id" value="">

        <div class="md-form mb-4">
               <label for="school_name"><h5>School name <span>*</span></h5></label>
               <input type="text" id="school_name" name="school_name" class="form-control" value="" placeholder="Enter school name">
            </div>

            <div class="md-form mb-4">
               <label for="branch"><h5>Branch name <span>*</span></h5></label>
               <input type="text" id="branch" value="" name="branch" class="form-control" value="" placeholder="Enter branch name">
            </div>

            <div class="md-form mb-4">
               <label for="address"><h5>Branch Address <span>*</span></h5></label>
               <textarea type="text" id="address" name="address" rows="2" class="form-control" placeholder="Enter branch address"></textarea>
            </div>

            <div class="md-form mb-4">
               <label for="mobile"><h5>Conatct no <span>*</span></h5></label>
               <input type="text" id="mobile" name="mobile" value="" class="form-control" placeholder="Enter contact number">
            </div>

            <div class="md-form mb-4">
               <label for="website"><h5>Website url <span>*</span></h5></label>
               <input type="text" id="website" name="website" value="" class="form-control" placeholder="Enter website url">
            </div>

            <div class="md-form mb-4">
                <label for="image"><h5>Branch image</h5></label>
                <input type="file" id="image_edit" name="image" class="form-control">
            </div>
            <img id="blah_edit" src="#" alt="your image" style="display:none;max-height: 250px;" />
            <div class="mt-2" id="avatar"></div>

      </div>
      <div class="modal-footer d-flex justify-content-center">

      <button type="submit" class="btn btn-success" id="update">Update</button>
      </form>

      </div>
    </div>
  </div>
</div>

@endsection
