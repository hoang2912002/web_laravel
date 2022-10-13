
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
                <form action="{{route('courses.update',$course)}}" method="POST">
                    @csrf
                    {{-- đối với form method là post thì luôn phải cần blade csrf để bảo mật hơn --}}
                    @method('PUT')
                    <label for="" class="form-inline">Name</label>
                    
                    <input class="form-control form-inline" type="text" name="name" value="{{$course->name}}">
                    
                    <br>
                    <button  class="btn btn-success float-right">Update</button>
                </form>
            </div> <!-- end tab-content-->

        </div> <!-- end card-body-->
    </div>
@endsection
