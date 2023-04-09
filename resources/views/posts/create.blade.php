@extends('layouts.app')

@section('title') Create @endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action={{ route('posts.store') }}>
        @csrf
        @method('POST')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title"  type="text" class="form-control" >
            @if ($errors->has('title'))
                <div class="alert alert-danger">
                            {{ $errors->first('title') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label  class="form-label">Contant</label>
            <textarea name="content" class="form-control"  rows="3"></textarea>
            @if ($errors->has('content'))
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
                {{--@foreach($users as $user)--}}
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                {{--@endforeach--}}
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
