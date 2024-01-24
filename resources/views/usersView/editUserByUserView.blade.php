@extends('usersView/userDashboard')


@section('content')
    <div class="col py-3">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Edit user by User</h3>

                                @if (Session::has('success'))
                                    {
                                    <div class="alert alert-primary alert-dismissible fade show">
                                        {{ Session::has('success') }}</div>
                                    }
                                @endif

                                {{-- {{$user}} --}}


                                <form method="post" action="{{route('editUserByUser')}}">

                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            aria-describedby="emailHelp" placeholder="Enter First name"
                                            value="{{ $user['fname'] }}">
                                        @if ($errors->has('fname'))
                                            <span class=" text-danger">{{ $errors->first('fname') }}</span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            aria-describedby="emailHelp" placeholder="Enter Last name"
                                            value="{{ $user['lname'] }}">
                                        @if ($errors->has('lname'))
                                            <span class="text-danger">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            aria-describedby="emailHelp" placeholder="Enter Last name"
                                            value="{{ $user['username'] }}" disabled>
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>


                                    <!-- Email input -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" placeholder="Enter email"
                                            value="{{ $user['email'] }}" disabled>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>



                                    <input type="hidden" class="" id="_token" name="_token"
                                        value="{{ csrf_token() }}">

                                    <input type="hidden" class="" id="id" name="id"
                                        value="{{ $user['id'] }}">

                                    <button type="submit" name="submit" class="btn btn-primary mt-5 ml-5">Submit</button>

                                    {{-- <a href="{{ route('cancelButton') }}"><button type="cancel" name="cancel"
                                            class="btn btn-danger mt-5 ml-5 ml-5">cancel</button></a> --}}

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
