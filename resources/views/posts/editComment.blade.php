@extends('layouts.app')

@section('title') Edit @endsection
@section('content')


    <form method="post" action="{{ route('comments.update' , $comment= $oldcomment['id']) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" value="{{ $oldcomment['name'] }}"  type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" value="{{ $oldcomment['email'] }}"  type="email" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Body</label>
            <textarea name="body"  class="form-control"  rows="3">{{ $oldcomment['body'] }}</textarea>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>

@endsection
