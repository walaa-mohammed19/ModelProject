<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <p> Teacher page </p>
        <div align="left">
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal"
                    style="margin:2px;">
                {{ __(' Add Teacher') }}
            </button>
        </div>

    </div>
</nav>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <table border="2" class="table table-striped">

                <thead>
                <tr>
                    <th> name</th>
                    <th> courses</th>
                    <th> action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($users as $userdata )

                    <tr>
                        <td>{{$userdata->name}}</td>
                        {{--<td>ggg</td>--}}
                        <td>{{@$userdata->courses_names_admin}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <form
                                        action="{{route('edit_teacher',$userdata->id)}}" method="get">
                                        {{csrf_field()}}
                                        <button type="button" class=" edit_teacher btn btn-success" data-toggle="modal"
                                                data-target="#editModal" style="margin:2px"
                                        data-id = "{{$userdata->id}}"
                                        data-name = "{{$userdata->name}}"
                                        data-email = "{{$userdata->email}}"
                                        data-phone = "{{$userdata->phone}}"
                                        data-image = "{{$userdata->image}}"

                                        > edit
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <form
                                        action="{{route('delete_teacher',$userdata->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger" style="margin:2px"
                                                onclick="return confirm('Are you sure?')">delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            <a href="{{ url('admin/dashboard')}}" class="btn btn-info" style="margin:2px">back</a>
        </div>
    </div>
</div>
{{--    start add Teacher--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store_teacher')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Enter name</label>
                        <div class="col-md-4">
                            <input type="text" name="name" id="name" class="form-control-static"
                                   placeholder="Enter the name ">
                            @if ($errors->has('name'))
                                <span style="color:red">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">email</label>
                        <div class="col-md-4">
                            <input type="email" name="email" id="email"
                                   class="form-control-static"
                                   placeholder="Enter the email ">
                            @if ($errors->has('email'))
                                <span style="color:red">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> password </label>
                        <div class="col-md-4">
                            <input type="password" name="password" id="password" class="form-control-static"
                                   placeholder="Enter the password ">
                            @if ($errors->has('password'))
                                <span style="color:red">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">confirm_password:</label>
                        <div class="col-md-4">
                            <input type="password" name="c_password" id="password" align="right"
                                   placeholder="Confirm Password ">
                            @if ($errors->has('c_password'))
                                <span style="color:red">
                  <strong>{{ $errors->first('c_password') }}</strong>
                      </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> phone </label>
                        <div class="col-md-6">
                            <input type="text" name="phone" id="phone" class="form-control-static"
                                   placeholder="Enter the phone ">
                            @if ($errors->has('phone'))
                                <span style="color:red">
                  <strong>{{ $errors->first('phone') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> add image:</label>
                        <div class="col-md-2">
                            <input type="file" name="image" id="image" align="right"
                                   accept="image" class="btn btn-outline-info">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-info">add teacher</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    start updata Teacher--}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> updata teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                        <form  id="teacherEditForm" action="" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
            <div class="modal-body">
                <input type="hidden" id="edit_teacher_id">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Enter name</label>
                    <div class="col-md-4">
                        <input type="text" name="name" id="edit_name" class="form-control-static" value="">
                               @if ($errors->has('name'))
                                   <span style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label"> Enter email</label>
                    <div class="col-md-4">
                        <input type="email" name="email" id="edit_email" class="form-control-static">
                        @if ($errors->has('email'))
                            <span style="color:red">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label"> Phone </label>
                    <div class="col-md-4">
                        <input type="text" name="phone" id="edit_Phone" class="form-control-static">
                        @if ($errors->has('Phone'))
                            <span style="color:red">
                  <strong>{{ $errors->first('Phone') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label"> add image:</label>
                    <div class="col-md-4">
                        <input type="file" name="image" id="edit_image" align="right"
                               accept="image" class="btn btn-outline-info">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-info update_teacher" >update teacher</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).on('click', '.edit_teacher', function (e) {
        e.preventDefault();
        var teacher_id = $(this).data("id");
            $('#edit_teacher_id').val(teacher_id);
        var name1 = $(this).data("name");
        $('#edit_name').val(name1);
        var email1 = $(this).data("email");
        $('#edit_email').val(email1);
        var phone1 = $(this).data("phone");
        $('#edit_Phone').val(phone1);
        var image1 = $(this).data("image");
        $('#edit_image').val(image1);


          // $('#editModal').modal('show');
        // var teacher_id = $(this).attr('id');
 // $.ajax({
 //     type:"GET",
 //     url:"admin/teachers/edit"+teacher_id/"edit",
 //     data:"data",
 //     dataType:"dataType",
 //     success:function (data){
 //
 //             $('#edit_name').val(data.name),
 //             $('#edit_email').val(data.email),
 //             $('#edit_Phone').val(data.Phone),
 //             $('#edit_image').val(data.image)
 //             $('#edit_teacher_id ').val(id)
 //
 //     }
 //     })
    });

    $(document).on('click', '.update_teacher', function (e) {
        e.preventDefault();
        var teacher_id = document.getElementById('edit_teacher_id').value;
        // var teacher_id = $('#edit_teacher_id').val();
        var fullName     = $("#edit_name").val();
        var emailAddress = $("#edit_email").val();
        var phoneteacher = $("#edit_phone").val();
        var imageteacher = $("#edit_image").val();


        // var data ={
        //     'name':$('#edit_name').val(),
        //     'email':$('#edit_email').val(),
        //     'phone':$('#edit_phone').val(),
        //     'image':$('#edit_image').val(),
        // }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "{{url('admin/teachers/update/')}}/" + teacher_id,
            // url:"admin/teachers/update/"+teacher_id,
            data: {
                name: fullName,
                email: emailAddress,
                phone: phoneteacher,
                image: imageteacher
            },
            success:function (){
                location.reload();
            }

        });
    });


 // $("#teacherEditForm").submit(function (e){
 //     e.preventDefault();
 //
 // })
</script>
</body>
</html>
