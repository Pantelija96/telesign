@extends('layout2')

@section('title') Profile settings @endsection

@section('profile')
active
@endsection

@section('pageName')
    <i class="ph-chalkboard-simple me-2"></i> Profile settings
@endsection

@section('additionalThemeJS')
@endsection

@section('additionalPageJS')
@endsection

@section('pageTitle')
    Profile settings
@endsection

@section('breadcrumb')
    <a href="{{url('/home2')}}" class="breadcrumb-item active">Projects</a>
    <span class="breadcrumb-item active">Profile settings</span>
@endsection

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Change your profile settings</h5>
        </div>

        <div class="card-body border-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form action="{{route('editUser')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="oldPassword" value="{{$userData['password']}}" />
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="name" style="text-align: right;">Name:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{$userData['name']}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="lastname" style="text-align: right;">Lastname:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Lastname" id="lastname" name="lastname" value="{{$userData['last_name']}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="email" style="text-align: right;">Email:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{$userData['email']}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="username" style="text-align: right;">Username:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="{{$userData['username']}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="password" style="text-align: right;">Password:</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="passwordA" style="text-align: right;">Password again:</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" placeholder="Password" name="passwordA" id="passwordA">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="role" style="text-align: right;">Role:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Role" name="role" id="role"  value="{{$userData['role']}}" readonly >
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save changes <i class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
