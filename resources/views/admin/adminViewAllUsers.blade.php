@extends('admin/adminDashboard')

@section('content')

<input type="submit" id="sendAllUsers" value="Send all users data" class="btn btn-secondary ms-3 mr-5 mb-3">


    <table id='users' name='users' class="table table-striped table-bordered">
        <thead>
            <tr>

                {{-- with post request --}}


                {{--  with get --}}

            </tr>
            <tr>
                <th style="width: 10%" scope="col">Id</th>
                <th style="width: 10%" scope="col">First name</th>
                <th style="width: 10%" scope="col">Last name</th>
                <th style="width: 10%" scope="col">Username</th>
                <th style="width: 20%" scope="col">Email</th>
                <th style="width: 15%" scope="col">Roles</th>
                <th style="width: 15" scope="col">Change Role</th>
                <th style="width: 5%" scope="col">Edit</th>
                <th style="width: 5%" scope="col">Delete</th>

            </tr>
        </thead>


        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['fname'] }}</td>
                    <td>{{ $user['lname'] }}</td>
                    <td>{{ $user['username'] }}</td>
                    <td>{{ $user['email'] }}</td>

                    {{-- this php code will store the role "$id" in the $rolesId array for the future use --}}
                    @php
                        $rolesId = [];
                        foreach ($user->roles as $key) {
                            $rolesId[] = $key->id;
                        }
                    @endphp

                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->role_name }},
                        @endforeach
                    </td>

                    <td>
                        <form action="{{ route('updateRole') }}" method="post">
                            @csrf
                            <input type="hidden" name="userId" value="{{ $user['id'] }}" />
                            {{-- radio button for roles --}}
                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" value="1" id="1" name="roles[]"
                                    {{ in_array(1, $rolesId) ? 'checked' : '' }}>
                                <label class="form-check-label" for="userCheck">
                                    User
                                </label>


                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="2" name="roles[]"
                                    {{ in_array(2, $rolesId) ? 'checked' : '' }}>
                                <label class="form-check-label" for="editorCheck">
                                    Editor
                                </label>
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>

                        </form>

                    </td>

                    <td><a class="ml-5" href="{{ route('editUserByAdmin', ['id' => $user['id']]) }}"><button
                                class="btn btn-primary">Edit</button></a></td>
                    <td><a href="{{ route('deleteUserByAdmin', ['id' => $user['id']]) }}" onclick="return con()"><button
                                class="btn btn-danger">Delete</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
