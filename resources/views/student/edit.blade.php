@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            @if ($errors->has('name'))
                        <span class="error">
                            {{$errors->first('name')}}
                        </span>
                    @endif
        </div>
        <div class="card-body">
            
            <div class="tab-content">
                <form action="{{route('students.update',$student)}}" method="POST">
                    @csrf
                    {{-- đối với form method là post thì luôn phải cần blade csrf để bảo mật hơn --}}
                    @method('PUT')
                    <label for="" class="form-inline">Name</label>
                    <input class="form-control form-inline" type="text" name="name" value="{{$student->name}}">
                    <br>

                    <label for=""class="form-inline">Birthdate</label>
                    <input class="form-control form-inline" type="date" name="birthdate" value="{{$student->birthdate}}">
                    <br>
                    
                    <label for=""class="form-inline">Gender</label>
                    
                   
                        <input type="radio" name="gender" value="{{$student->gender}}"                     
                        @isset($student->gender)
                            checked
                        @endisset>
                        {{ Auth::check($student->gender === 0 ) ? 'Male' : 'Female' }}
                        <br>
                        @php
                            if ($student->gender === 0)
                            echo 'male';
                            else
                            echo 'Female';
                        @endphp
                        
                        
                    
                    
                    <br>

                    <label for=""class="form-inline">Status</label>
                    @foreach ($arrstudentStatus as $option=>$value)
                            <input  type="radio" name="status" value="{{ $value }}" 
                            @if ($value === $student->status) 
                                checked  
                            @endif> 
                            <label class="mr-2"for="">{{$option}}</label>
                        @endforeach
                    <br>

                    <label for=""class="form-inline">Course</label>
                    <select name="" id="">
                        @foreach ($course as $item)
                            @if($item->id === $student->course_id)
                                <option value="{{$student->course_id}}">
                                     {{$item->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <button  class="btn btn-success float-right">Update</button>
                </form>
            </div> <!-- end tab-content-->

        </div> <!-- end card-body-->
    </div>
@endsection
