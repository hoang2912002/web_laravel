{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<form action="{{route('courses.store')}}" method="POST">
    @csrf
    {{-- đối với form method là post thì luôn phải cần blade csrf để bảo mật hơn --}}
    Name
    <input type="text" name="name" value="{{old('name')}}">
    @if ($errors->has('name'))
        <span class="error">
            {{-- <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            Đây là cách in ra lỗi vì nó luôn trả về là số nhiều nên cần in ra mảng
            để trả về kể cả khi chỉ có 1 lỗi    
             --}}
            {{$errors->first('name')}}
        </span>
    @endif
    <br>
    <button>Create</button>
</form>