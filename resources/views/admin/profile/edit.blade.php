@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
        <!-- <small>Preview</small> -->
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Horizontal Form</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->

    <div class="box-body">

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} row">
                        <label for="new-password" class="col-md-4 control-label">Current Password</label>
                    <div class="col-sm-8">
                        <input id="current-password" type="password" class="form-control border border-dark" name="current-password" required>

                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }} row">
                        <label for="new-password" class="col-md-4 control-label">New Password</label>
                    <div class="col-sm-8">
                        <input id="new-password" type="password" class="form-control border border-dark" name="new-password" required>

                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>

                <div class="form-group row">
                        <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                    <div class="col-sm-8">
                        <input id="new-password-confirm" type="password" class="form-control border border-dark" name="new-password_confirmation" required>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success text-white">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>



 
     
    
          </div>
          <!-- /.box -->
          
         
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


@endsection