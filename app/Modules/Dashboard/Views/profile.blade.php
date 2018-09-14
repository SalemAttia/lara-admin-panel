@extends('Dashboard::layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center">Nina Mcintire</h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    {{--<ul class="list-group list-group-unbordered">--}}
                        {{--<li class="list-group-item">--}}
                            {{--<b>Followers</b> <a class="pull-right">1,322</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item">--}}
                            {{--<b>Following</b> <a class="pull-right">543</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item">--}}
                            {{--<b>Friends</b> <a class="pull-right">13,287</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" method="POST" action="{{ url('/admin/profile') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Full Name">
                                    @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                                    @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="inputOldPass" class="col-sm-2 control-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="old_password" class="form-control" id="inputOldPass" placeholder="Old Password">
                                    @if ($errors->has('old_password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('old_password') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="inputNewPass" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="new_password" class="form-control" id="inputNewPass" placeholder="New Password">
                                    @if ($errors->has('new_password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('new_password') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('confirm_new_password') ? ' has-error' : '' }}">
                                <label for="inputReNewPass" class="col-sm-2 control-label">Confirm New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="confirm_new_password" class="form-control" id="inputReNewPass" placeholder="Confirm New Password">
                                    @if ($errors->has('confirm_new_password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection