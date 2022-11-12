{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
@extends('layout.master')
@section('content')
    

    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                    
                    <form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- đối với form method là post thì luôn phải cần blade csrf để bảo mật hơn --}}
                        <label class="mr-2" for="">Name:</label>
                        <input class="form-control" type="text" name="name" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <span class="error">
                                {{$errors->first('name')}}
                            </span>
                        @endif
                        <br>
                        <label class="mr-2" for="">Birthdate</label>
                        <input  class="form-control" type="date" name="birthdate" id="">
                        <br>
                        <label  class="mr-2" for="">Gender</label>
                        <input type="radio" value="0" name="gender" checked>Male
                        <input type="radio" value="1" name="gender">Female
                        <br>
                        <label for="">Status</label>
                        @foreach ($arrstudentStatus as $option=>$value)
                            <input  type="radio" name="status" value="{{ $value }}" 
                            @if ($loop->first) 
                                checked  
                            @endif> 
                            <label class="mr-2"for="">{{$option}}</label>
                        @endforeach
                            
                        <br>
                        <label for=""class="mr-2">Avatar</label>
                        <input type="file" name="avatar" id="">
                        <br>
                        <label for="">Course id</label>
                        <select name="course_id" id="id">
                            @foreach ($course as $item)
                                <option value="{{$item->id}}">
                                    {{$item->name}}
                                </option>
                            @endforeach
                            {{--   --}}
                        </select>
                        <button class="btn btn-success float-right">Create</button>
                    </form>                           
            </div> <!-- end tab-content-->
        </div> <!-- end card-body -->
    </div>
@endsection
