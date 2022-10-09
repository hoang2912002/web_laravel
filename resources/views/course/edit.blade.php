<form action="{{route('courses.update',$course)}}" method="POST">
    @csrf
    {{-- đối với form method là post thì luôn phải cần blade csrf để bảo mật hơn --}}
    @method('PUT')
    Name
    <input type="text" name="name" value="{{$course->name}}">
    @if ($errors->has('name'))
        <span class="error">
            {{$errors->first('name')}}
        </span>
    @endif
    <br>
    <button>Update</button>
</form>