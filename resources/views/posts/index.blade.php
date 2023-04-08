@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <script>
        function deletePost(event) {
           let form = document.querySelector('#form');
           form.action = '/posts/' + event.target.parentNode.parentNode.childNodes[1].innerHTML;
        }
    </script>
    <div class="text-center">
        <a href="/posts/create" class="btn btn-success">Creat New</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->User->name}}</td>
                <td>{{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>
                <td>
                    <a href="/posts/{{$post['id']}}" class="btn btn-info">View</a>
                    <a href="/posts/{{$post['id']}}/edit" class="btn btn-primary">Edit</a>
                    <a href="#" onclick="deletePost(event)" id="deleteButton" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a>
                </td>
            </tr>

        @endforeach


        </tbody>
    </table>
            {!! $posts->links() !!}


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form" action="/posts/" method="post">
                @csrf
                @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sure You Want To Delete This Post?
                    <h4 id="postId"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success">Delete</button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
