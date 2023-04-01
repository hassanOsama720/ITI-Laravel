@extends('Layout.app')

@section('title') Create @endsection

@section('content')
    <form method="post" action={{ route('posts.store') }}>
        @csrf
        @method('POST')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title"  type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Contant</label>
            <textarea name="content" class="form-control"  rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="post_by" class="form-control">
                <option value="ahmed">Ahmed</option>
                <option value="mohamed">Mohamed</option>
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
