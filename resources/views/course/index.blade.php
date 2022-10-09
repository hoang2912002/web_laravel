@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- <body style=" background-image:linear-gradient(to right,rgb(255,102,102),rgb(255,102,128))"> --}}
    <a href="{{route('courses.create')}}">Thêm</a>
<style>
    span{
        width: ;
    }
</style>
<table border="1" style="width: 100%;">
    <caption>
        <form action="">
            Search: <input type="search" name="q" id="" value="{{$search}}">
        </form>
    </caption>
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
                <a href="{{route('courses.edit',$each)}}">Edit</a>
            </td>
            <td>
                <form action="{{ route( 'courses.destroy', $each) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
            {{--Mình có thể làm tắt đc như thế này nếu mà cột khóa chính là cột id--}}
            {{--Ở laravel thì mình k dùng thẻ a thể làm điều hướng delete column như bên php thuần đc
                vì bản chất method chỉ có 2 loại POST và GET k có method DELETE nên là mình cần phải thay
                bằng form và chuyển method cho nó thành 'DELETE' thông qua blade @method('DELETE')--}}
        </tr>
    @endforeach
</table>
{{ $data->links() }}
