@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Edit Course</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Course</li>
            </ol>
        </div>
        
        <div class="col-12 col-lg-6">
            <div class="float-end">
                <a class="btn btn-sm btn-success" href="{{ route('courses.index') }}"> Back</a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-lg-6">

            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('courses.update', $course) }}" method="POST">
                @csrf
                @method('PUT')
            
                <div class="row">
                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" value="{{  $course->name }}" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mt-2">
                            <label>Description:</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description" required>
                                {{  $course->description }}
                            </textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
@endsection