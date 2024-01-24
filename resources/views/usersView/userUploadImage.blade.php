@extends('usersView/userDashboard')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Upload image Form</h3>


                            @if (Session::has('success'))
                                <div class='alert alert-primary'>{{ Session::get('success') }}</div>
                            @endif


                            <form method="post" action="{{route('userUploadImagePost')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="image">Please select image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter email">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <button type="submit" name="submit" class="btn btn-primary mt-5 ml-5">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
