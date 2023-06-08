<tr id="todo{{$todo->id}}">
    <td>{{$todo->id}}</td>
    <td>{{$todo->title}}</td>
    <td>{{$todo->description}}</td>
    <td>
        @foreach($todo->tags as $tag)
            <span class="badge badge-primary">
                {{ $tag->name }}
            </span>
        @endforeach
    </td>
    <td>
        @foreach($todo->images as $image)
            <a href="{{ route("todo.image.show", ['image_id' => $image->id]) }}" style="width: 150px; height: 150px" class="d-inline-block">
                <img src="/{{$image->path}}" alt="" class="w-100 h-100" style="object-fit: cover">
            </a>
        @endforeach
    </td>
    <td>
        <a href="#" route="{{ route('todo.update', ['todo_id' => $todo->id]) }}" class="btn-edit" data="{{ $todo }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                <path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path>
            </svg>
        </a>


        <form action="{{ route('todo.delete', ['todo_id' => $todo->id]) }}" method="post">
            @method('DELETE')
            @csrf
            <svg onmouseover="" style="cursor: pointer;" onclick="document.getElementById('delete-todo').click()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                <path d="M11 1.75V3h2.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75ZM4.496 6.675l.66 6.6a.25.25 0 0 0 .249.225h5.19a.25.25 0 0 0 .249-.225l.66-6.6a.75.75 0 0 1 1.492.149l-.66 6.6A1.748 1.748 0 0 1 10.595 15h-5.19a1.75 1.75 0 0 1-1.741-1.575l-.66-6.6a.75.75 0 1 1 1.492-.15ZM6.5 1.75V3h3V1.75a.25.25 0 0 0-.25-.25h-2.5a.25.25 0 0 0-.25.25Z"></path>
            </svg>
            <button type="submit" class="d-none" id="delete-todo"></button>
        </form>

        <form class="d-inline-block" action="{{ route('todo.attach.images', ['todo_id' => $todo->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="d-none" type="file" name="images[]" placeholder="Choose image" onchange="form.submit()" id="image{{$todo->id}}" multiple>

            <svg onmouseover="" style="cursor: pointer;" onclick="document.getElementById(`{{'image'.$todo->id}}`).click()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                <path d="M12.212 3.02a1.753 1.753 0 0 0-2.478.003l-5.83 5.83a3.007 3.007 0 0 0-.88 2.127c0 .795.315 1.551.88 2.116.567.567 1.333.89 2.126.89.79 0 1.548-.321 2.116-.89l5.48-5.48a.75.75 0 0 1 1.061 1.06l-5.48 5.48a4.492 4.492 0 0 1-3.177 1.33c-1.2 0-2.345-.487-3.187-1.33a4.483 4.483 0 0 1-1.32-3.177c0-1.195.475-2.341 1.32-3.186l5.83-5.83a3.25 3.25 0 0 1 5.553 2.297c0 .863-.343 1.691-.953 2.301L7.439 12.39c-.375.377-.884.59-1.416.593a1.998 1.998 0 0 1-1.412-.593 1.992 1.992 0 0 1 0-2.828l5.48-5.48a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042l-5.48 5.48a.492.492 0 0 0 0 .707.499.499 0 0 0 .352.154.51.51 0 0 0 .356-.154l5.833-5.827a1.755 1.755 0 0 0 0-2.481Z"></path>
            </svg>
        </form>

        <a href="#" class="btn-tag d-block" data="{{$todo->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                <path d="M1 7.775V2.75C1 1.784 1.784 1 2.75 1h5.025c.464 0 .91.184 1.238.513l6.25 6.25a1.75 1.75 0 0 1 0 2.474l-5.026 5.026a1.75 1.75 0 0 1-2.474 0l-6.25-6.25A1.752 1.752 0 0 1 1 7.775Zm1.5 0c0 .066.026.13.073.177l6.25 6.25a.25.25 0 0 0 .354 0l5.025-5.025a.25.25 0 0 0 0-.354l-6.25-6.25a.25.25 0 0 0-.177-.073H2.75a.25.25 0 0 0-.25.25ZM6 5a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"></path>
            </svg>
        </a>

    </td>

</tr>
