@extends('admin/adminDashboard')

@section('content')
{{-- {{$users}} --}}

<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">First name</th>
        <th scope="col">Last name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>

      </tr>
    </thead>

    
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user["fname"]}}</td>
            <td>{{$user["lname"]}}</td>
            <td>{{$user["username"]}}</td>
            <td>{{$user["email"]}}</td>
            <td><a class="ml-5" href="{{ route('editUserByAdmin' ,['id'=> $user['id']]) }}" ><button class="btn btn-primary">Edit</button></a></td>
            <td><a href="{{ route('deleteUserByAdmin' ,['id'=> $user['id']]) }}" onclick="return con()"><button class="btn btn-danger">Delete</button></a></td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection