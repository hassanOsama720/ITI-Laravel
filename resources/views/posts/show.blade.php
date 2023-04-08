@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            Title : {{$post->title}}
        </div>
        <div class="card-body">
            <p class="card-text">{{$post->content}}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name : {{ $post->User->name }}</h5>
            <p class="card-text">Email : {{ $post->User->email }}</p>
            <p class="card-text">Created At : {{ $post->created_at }}</p>
        </div>
    </div>

    <div style="border: solid 2px #eee; padding: 10px; margin-top: 20px" class="cont">
        <form method="post" action={{ route('comments.store') }}>
            @csrf
            @method('POST')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name"  type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <input hidden="hidden" name="commentable_id" value="{{ $post->id }}"  type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email"  type="email" class="form-control" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Body</label>
                <textarea name="body" class="form-control"  rows="3"></textarea>
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>


    <section style="background-color: #ad655f;">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card text-dark">
                        @foreach($post->comments->toArray() as $comment)
                            <div class="card-body p-4">
                                <div class="d-flex flex-start">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp" alt="avatar" width="60"
                                         height="60" />
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $comment['name'] }}</h6>
                                        <h6 class="fw-bold mb-1">{{ $comment['email'] }}</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <p class="mb-0">
                                                {{\Carbon\Carbon::parse($comment['created_at'])->format('d/m/Y')}}
                                                <span class="badge bg-primary">Approved</span>
                                            </p>

                                        </div>
                                        <p class="mb-0">
                                            {{ $comment['body'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex">
                                <form action="{{ route('comments.destroy', $comment['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button style="margin: 10px" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <form action="{{ route('comments.edit', $comment['id']) }}">
                                    @csrf
                                    <button style="margin: 10px" type="submit" class="btn btn-success">Edit</button>
                                </form>
                            </div>

                            <hr class="my-0" />
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
