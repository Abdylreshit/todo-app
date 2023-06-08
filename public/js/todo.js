$(document).ready(function ($) {

    $('#tag-filter').select2();
    // $('#image').change(function (event) {
    //     const imageFiles = event.target.files;
    //     let reader = new FileReader();
    //     reader.onload = (e) => {
    //         $('#preview-image-before-upload').attr('src', e.target.result);
    //     }
    //     reader.readAsDataURL(this.files[0]);
    // });

    let route;
    let method;
    let todo_id;

    $('#btn-add').click(function () {
        route = $(this).attr('route');
        method = "POST";
        $('#btn-save').val("add");
        $('#myForm').trigger("reset");
        $('#title').val('');
        $('#description').val('');
        $('#formModal').modal('show');
    });

    $('.btn-tag').click(function (){
        $('#formTagModal').modal('show');
        let id = $(this).attr('data');
        $('#tag_todo_id').val(id);
        console.log(id);
    })

    $('.btn-edit').click(function () {
        route = $(this).attr('route');
        method = "PUT";
        $('#myForm').trigger("reset");
        let data = JSON.parse($(this).attr('data'));
        todo_id = data['id'];
        $('#title').val(data['title']);
        $('#description').val(data['description']);
        $('#btn-save').val('edit');
        $('#formModal').modal('show');
    });

    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        let formData = {
            title: $('#title').val(),
            description: $('#description').val(),
        };
        let state = $('#btn-save').val();
        $.ajax({
            type: method,
            url: route,
            data: formData,
            dataType: 'html',
            success: function (data) {
                let todo = data;
                if (state == "add") {
                    $('#todo-list').append(todo);
                } else {
                    $("#todo" + todo_id).replaceWith(todo);
                }
                $('#myForm').trigger("reset");
                $('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
