{{--Muốn ôm tất cả course để hiển thị ở bên layout thì mình cần phải kế thừa nó
và dùng hàm extends()  
  @section() để viết nội dung vào thằng ở giữa bên master đã khai báo có tên là "content"
--}}
@extends('layout.master')
@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div> 
        @endif
        
        <div class="card-body">
            <a class="btn btn-success" href="{{route('courses.create')}}">Thêm</a>

            <form action="" class="float-right form-group form-inline">
                <label class="mr-2" for="">Search: </label>
                <input type="search" name="q" id="" value="{{$search}}" class="form-control">
            </form>
            <table class="table table-centered mb-0" >
                
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Create At</th>
                    <td>Edit</td>
                    <th>Delete</th>
                </tr>
                @foreach ($data as $each)
                    <tr>
                        <td>{{$each->id}}</td>
                        <td>{{$each->name}}</td>
                        {{-- <td>{{$each->created_at->diffForHumans()}}</td>
                        <td>{{date("F jS, Y",strtotime($each->created_at))}}</td> --}}
                        <td>{{$each->year_created_at}}</td>
                        {{-- <td><a href="{{ route( 'course.destroy', ['course'=>$each->id]) }}">Delete</a></td> --}}
                        <td>
                            <a class="btn btn-primary" href="{{route('courses.edit',$each)}}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route( 'courses.destroy', $each) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        {{--Mình có thể làm tắt đc như thế này nếu mà cột khóa chính là cột id--}}
                        {{--Ở laravel thì mình k dùng thẻ a thể làm điều hướng delete column như bên php thuần đc
                            vì bản chất method chỉ có 2 loại POST và GET k có method DELETE nên là mình cần phải thay
                            bằng form và chuyển method cho nó thành 'DELETE' thông qua blade @method('DELETE')--}}
                    </tr>
                @endforeach
            </table>
            
            <nav>
                <ul class="pagination pagination-rounded mb-0">
                    {{ $data->links() }}
                </ul>
            </nav>
        </div>
    </div>
    
@endsection