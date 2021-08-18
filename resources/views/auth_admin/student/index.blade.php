<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Studen </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <p> Student page </p>
        <div align="left">
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal"
                    style="margin:2px;">
                {{ __(' Add Student') }}
            </button>

            {{--            <form--}}
            {{--                action="" method="">--}}
            {{--                {{csrf_field()}}--}}
            {{--                <button type="submit" class="btn btn-info" style="margin:2px"--}}
            {{--                >add course&Teacher--}}
            {{--                </button>--}}
            {{--            </form>--}}
        </div>

    </div>
</nav>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <table border="2" class="table table-striped">

                <thead>
                <tr>
                    <th> name</th>
                    <th> action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($users as $userdata )

                    <tr>
                        <td>{{$userdata->name}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <form
                                        action="{{route('edit_student',$userdata->id)}}" method="get">
                                        {{csrf_field()}}
                                        <button type="button" class=" edit_student btn btn-success" data-toggle="modal"
                                                data-target="#editModal" style="margin:2px"
                                                data-id="{{$userdata->id}}"
                                                data-name="{{$userdata->name}}"
                                                data-email="{{$userdata->email}}"
                                                data-phone="{{$userdata->phone}}"
                                                data-image="{{$userdata->image}}"

                                        > edit
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <form
                                        action="{{route('delete_student',$userdata->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger" style="margin:2px"
                                                onclick="return confirm('Are you sure?')">delete
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-info show_course"   data-toggle="modal"
                                            data-target="#showCourseModal" style="margin:2px"
                                            data-student_id ="{{$userdata->id}}"
                                    > course
                                    </button>
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
{{--    start add Student--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store_student')}}" method="post" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-outline-info">add student</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    start updata Student--}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> updata student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="studentEditForm" action="" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="modal-body">
                    <input type="hidden" id="edit_student_id">
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
                    <button type="button" class="btn btn-outline-info update_student">update student</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    end updata Student--}}

{{--    start show course and Teacher--}}
<div class="modal fade" id="showCourseModal" tabindex="-1" role="dialog" aria-labelledby="showCourseModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCourseModalLabel"> courses & teacher </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Course</th>
                        <th scope="col">teacher</th>
                    </tr>
                    </thead>
                    <tbody id="tablebody" >
{{--                    @foreach($Teacher as $teacher1)--}}
{{--                        <tr>--}}
{{--                            <td>{{$teacher1->name}}</td>--}}
{{--                            <td>{{$teacher1->name}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}

                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                <div class="col-md-3">
                    <button   style="font-size:11px" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addCourseModal"
                            style="margin:2px"
                    > add course&teacher
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="editModalLabel">  add courses & teacher </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store_course_teacher')}}" method="post"  >
                {{csrf_field()}}
            <div class="modal-body">

                <div class="form-group">
                    <label>selected the courses</label>
                    <select class="form-control form-control-lg" name="course_id" id="course_id">
                        <option selected> Open this select menu</option>
                        @foreach($courses as $course)
                            <option value="{{$course->id}}">{{ $course->name}}</option>
                        @endforeach
                    </select>
                </div>
                      <div class="form-group">
                        <label> selected the teacher </label>
                          <input type="text" class="form-control form-control-lg" name="user_id" id="user_id" disabled>
{{--                        <select class="form-control form-control-lg" name="user_id" id="user_id">--}}
{{--                            <option selected> Open this select menu</option>--}}
{{--                            @foreach($Teacher as $teacher1)--}}
{{--                                <option value="{{$teacher1->id}}">{{ $teacher1->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                    </div>
                    <button type="submit" class="btn btn-primary">add</button>
            </div>
                </form>

            </div>
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

    $(document).on('click', '.edit_student', function (e) {
        e.preventDefault();
        var student_id = $(this).data("id");
        $('#edit_student_id').val(student_id);
        var name1 = $(this).data("name");
        $('#edit_name').val(name1);
        var email1 = $(this).data("email");
        $('#edit_email').val(email1);
        var phone1 = $(this).data("phone");
        $('#edit_Phone').val(phone1);
        var image1 = $(this).data("image");
        $('#edit_image').val(image1);

    });

    $(document).on('click', '.update_student', function (e) {
        e.preventDefault();
        var student_id = document.getElementById('edit_student_id').value;
        var fullName = $("#edit_name").val();
        var emailAddress = $("#edit_email").val();
        var phonestudent = $("#edit_phone").val();
        var imagestudent = $("#edit_image").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "{{url('admin/Student/update/')}}/" + student_id,
            // url:"admin/Student/update/"+student_id,
            data: {
                name: fullName,
                email: emailAddress,
                phone: phonestudent,
                image: imagestudent
            },
            success: function () {
                location.reload();
            }

        });
    });


</script>

<script>
    // user_id=$(this).getElementById('user_id').val();
    // $('#course_id').on('change', function() {
    //     id = $(this).getElementById('course_id').val();
    //     $(this).u(id);
    //
    //
    //
    // });
    // function u(){
    // $(document).ready(function (e){
    $('#course_id').on('change', function() {
        var course_id= $("#course_id :selected").val();
    // var course_id1 = $('#course_id').select().val();
    //     console.log(course_id1);
    //     alert(course_id);
        $.ajax({
            type: "get",
            url: "{{url('admin/Student/getTeacher/')}}/" + course_id,

            success: function (data) {
                var name = data.name;
                // $('#user_id').value=name;
                $('#user_id').val(name);
                // $('#user_id').append(name);
            }
        });
    }) ;

    // }

</script>
<script>
    $(document).on('click', '.show_course', function (e) {
        e.preventDefault();
        // var student_id = $('#student_id').val();
        var student_id =  $(this).data('student_id');
        var table_body = $("#tablebody");
        // alert(student_id);
        // alert('kv');
        $.ajax({
            type: "get",
            url: "{{url('admin/Student/getUserCourse/')}}/" + student_id,

            success: function (data) {
                var grades = data.data;
                console.log(grades);
                // console.log(Object.keys(grades).length);
                var data = '';
                // console.
                $('#user_id').append(name);
                // $.each(grades, function( key,grade){
                //     data += ' <tr><td>' + grade.course_name + ' </td>' +
                //             '<td>' + grade.teacher_name + ' </td>' +
                //             '</tr>';

                    for (var key in grades) {
                        data += ' <tr><td>' + grades[key]['course_name'] + ' </td>' +
                            '<td>' + grades[key]['teacher_name'] + ' </td>' +
                            '</tr>';
                    }
                // });
                table_body.empty();
                table_body.append(data);
            }

        });
    });




</script>
</body>
</html>
