<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <p> Course page </p>
        <div align="left">
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal"
                    style="margin:2px;">
                {{ __(' Add Course') }}
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
                    <th> name </th>
                    <th> teacher </th>
                    <th> action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($course as $coursedata )
                    <tr>
                        <td>{{$coursedata->name}}</td>
{{--                        @dd($coursedata->user())--}}
                        <td>{{@$coursedata->user->name}}</td>

                        <td>
                            <div class="row">
                                <div class="col-md-3">
{{--                                    <button id="test">hhh</button>--}}
                                        <button type="button" id="course_btn" class=" edit_course btn btn-success" data-toggle="modal"
                                                data-target="#editModal" style="margin:2px"
                                                data-id = "{{$coursedata->id}}"
                                                data-name = "{{$coursedata->name}}"
                                                data-user_id="{{$coursedata->user_id}}"
                                        > edit
                                        </button>

                                </div>
                                <div class="col-md-3">
                                    <form
                                        action="{{route('delete_course',$coursedata->id)}}" method="POST">
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
{{--    start add course--}}
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
            <form action="{{route('store_course')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <input type="hidden" id="edit_course_id">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Enter name course</label>
                        <div class="col-md-8">
                            <input  class="form-control form-control-lg" type="text" value="" name="name"
                                    id="name">
                            @if ($errors->has('name'))
                                <span style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> Enter the teacher</label>
                        <div class="col-md-8">
                    <select class="form-control form-control-lg" name="user_id" id="user_id">
                        <option selected> Open this select menu</option>
                        @foreach($users as $user1)
                            <option value="{{$user1->id}}">{{ $user1->name}}</option>
                        @endforeach
                    </select>
                    <br>
                </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-info">add course</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    start updata course--}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> updata course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="CourseEditForm" action="" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="modal-body">
                        <input type="hidden" id="edit_course_id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Enter name course</label>
                            <div class="col-md-8">
                                <input  class="form-control form-control-lg" type="text"
                                        name="name" id="edit_name"  value="">
                                @if ($errors->has('name'))
                                    <span style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"> Enter the teacher</label>
                            <div class="col-md-8">
                                <select class="form-control form-control-lg" name="user_id" id="edit_user_id">
{{--                                    <option selected> Open this select menu</option>--}}
                                    @foreach($users as $user)
{{--                                        <option value="{{$user1->id}}"  @if ($user1->id==$course->teacher_id) selected="" @endif>{{$user1->name}}</option>--}}
{{--                                 @dd($user->id==$coursedata->user_id)--}}
{{--                                        <option value="" >ll</option>--}}
                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-info update_course" >update teacher</button>
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

//    $(document).on('click', '#test', function (e) {
//        alert('gggg');
//
//    });
//     $('#test').click(function (e){
//         alert('gggg');
//
//     });
    $(document).on('click', '#course_btn', function (e) {
        e.preventDefault();
        // alert('gggg');
        var course_id = $(this).data("id");
        $('#edit_course_id').val(course_id);
        var name1 = $(this).data("name");
        $('#edit_name').val(name1);
        var select = $(this).data("user_id");
        $('#edit_user_id').val(select);
        console.log(select);

        // alert(select);
        // alert($("#edit_user_id").val());

    });

    $(document).on('click', '.update_course', function (e) {
        e.preventDefault();
          var course_id = document.getElementById('edit_course_id').value;
          var fullName     = $("#edit_name").val();
          // alert($("#edit_user_id").val());
          var user_id     = $("#edit_user_id").val();
          // var select1 ;

        // $('#teacher_id_edit').on('change', function() {
        //     select1 = $(this).children("option:selected").val();
        // });

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: "PUT",
            url: "{{url('admin/course/update/')}}/" + course_id,
            data: {
                name: fullName,
                user_id: user_id,
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

