@extends('usersView.userDashboard')

@section('content')
    {{-- {{$images}} --}}

    <table>
        <thead>

        </thead>
        <tbody class="table-bordered ">
            @foreach ($images as $key => $image)
                @if ($key % 3 == 0)
                    <tr>
                @endif
                <td><img class="mt-2 ms-2 mr-3"  style="border-radius: 5px,border:1px solid" src="{{asset('storage/images/'.$image->imagePath)}}" alt="Creative_.ks" height="300" width="400"><br>
                    <a href="{{ asset('storage/images/'.$image->imagePath)}}"><button class="btn mt-2 ms-1 mb-2 btn-primary" value="Download">View</button></a>
                    <a href="{{ route('downloadImage',['path'=>$image->imagePath])}}"><button class="btn mt-2 ms-1 mb-2 btn-secondary" value="Download">Download</button></a>
                    <a href="{{ route('deleteImage',['id'=>$image->productId])}}"><button class="btn mt-2 ms-1 mb-2 btn-danger" value="Download">Delete</button></a>
                </td>
                {{-- {{$image}} --}}

                @if (($key + 1) % 3 == 0 || $loop->last)
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
@endsection
