@extends('layouts.app')

@section('title') Edit @endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{ route('posts.update' , $post= $oldpost['id']) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title"  value="{{ $oldpost['title'] }}" type="text" class="form-control" >
            @if($errors->has('title'))
                <div class="alert alert-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label  class="form-label">Contant</label>
            <textarea name="content"  class="form-control"  rows="3">{{ $oldpost['content'] }}</textarea>
            @if($errors->has('content'))
                <div class="alert alert-danger">
                    {{ $errors->first('content') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label  class="form-label">Image</label>
            <input name="image" type="file" class="form-control" >
            @if ($errors->has('image'))
                <div class="alert alert-danger">
                    {{ $errors->first('image') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="user_id" class="form-control">
                <option value="{{ $oldpost->User->id }}">{{ $oldpost->User->name }}</option>
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
