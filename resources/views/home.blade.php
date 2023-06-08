@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2>Todo list</h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <button class="btn btn-success" id="btn-add" route="{{ route('todo.store') }}">
                    Add Todo
                </button>
            </div>
        </div>

        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2></h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <form action="{{ route('todo.index') }}">
                    <select name="tags[]" id="tag-filter" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                    @if(request()->tags && in_array($tag->id, request()->tags))
                                        {{ "selected" }}
                                    @endif
                            >{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary" value="search">
                </form>
            </div>
        </div>

        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2></h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <form action="{{ route('todo.index') }}">
                    <input type="text" name="q" placeholder="Search">
                    <input type="submit" class="btn btn-primary" value="search">
                </form>
            </div>
        </div>
        <div>
            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Tags</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="todo-list">
                @foreach ($todos as $todo)
                    @include('action', ['todo' => $todo])
                @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="formModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Create Todo</h4>
                        </div>
                        <div class="modal-body">
                            <form id="myForm" name="myForm" enctype="multipart/form-data" class="form-horizontal" novalidate="">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Enter title" value="">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           placeholder="Enter Description" value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                            </button>
                            <input type="hidden" id="todo_id" name="todo_id" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="formTagModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formTagModalLabel">Add todo</h4>
                        </div>
                        <form name="myTagForm" action="{{ route('todo.attach.tag') }}" method="POST" class="form-horizontal">
                            @csrf
                        <div class="modal-body">


                                <div class="form-group">
                                    <label>Tag</label>
                                    <input type="text" class="form-control" id="tag" name="name"
                                           placeholder="Enter tag" value="">
                                </div>

                        </div>
                        <input type="hidden" id="tag_todo_id" name="todo_id" value="">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" value="add">Save
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            {{ $todos->links() }}
        </div>
    </div>
@endsection
