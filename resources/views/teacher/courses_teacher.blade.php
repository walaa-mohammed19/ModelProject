<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <title>teacher courses </title>
</head>

<body>
<ul>
{{--    <li><a class="btn" style="padding:14px 16px;" href="">علامات الطلاب</a></li>--}}
    <li style="float:right;"><a href="{{ route('profle_teacher') }}">الصفحةالرئيسية</a></li>
</ul>
<div class="container">
    <div class="row container   justify-content-center">
        <div class="col-md-4">
            <div class="row m-l-1 m-r-1">
                <table>
                    <thead>
                    <tr>
                        <th> course</th>
                        <th> student</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teacher->teachers as $course)
                        <tr>
                            <td>{{$course->name }}</td>
                            <td><a style="font-size:18px" type="button" class="btn btn-light btn-sm show_student"
                                   data-toggle="modal"
                                   data-target="#studentModal"
                                   style="margin:2px"
                                   data-course_id="{{$course->id}}"
                                > student
                                </a>
                                <button type="submit" type="button" data-toggle="modal"
                                        data-target="#addModal" class="btn btn-outline-info add_student"
                                        style="margin:3px;"
                                        data-course_id="{{$course->id}}"
                                >add

                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="studentModal" tabindex="-1" role="dialog"
     aria-labelledby="studentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style=" width:800px; height:500px ; align-content: center">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel"> student & grade </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="page-header" align="center">
                    <div class="col-md-4">
                        <div class="row m-l-1 m-r-1">

                            <table>
                                <thead>
                                <tr>
                                    <th> student</th>
                                    <th> grade</th>
                                    <th> update</th>
                                </tr>
                                </thead>
                                <tbody id="tablebody">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog"
     aria-labelledby="addModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style=" width:800px; height:300px">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel"> add student </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add_student')}}" method="post">
                    {{csrf_field()}}
                    {{--                    <div class="page-header container mr-2">--}}
                    {{--                    <select > <option>1111</option><option>555</option></select>--}}
                    <input type="hidden" id="course_id1" name="course_id">
                    <div class="form-group ">
                        <select name="user_id[]" id="user_id" class="form-control selectpicker" data-actions-box="true"
                                multiple data-live-search="true">
                            @foreach($users as $user)
                                <option value={{$user->id}}>{{$user->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>--}}

<script>
    $(document).on('click', '.show_student', function (e) {
        e.preventDefault();
        var course_id = $(this).data('course_id');
        // alert(course_id);
        var table_body = $("#tablebody");

        $.ajax({
            type: "get",
            url: "{{url('teacher/get_student/')}}/" + course_id,

            success: function (data) {
                var grades = data.data;
// console.log(data.data);
                var data = '';
                // console.log(grades);
                for (var key in grades) {
                    var grade_student = grades[key]['student_grade'];
                    var student_id = grades[key]['student_id'];
                    var course_id = grades[key]['course_id'];
                     {{--var url = "{{route('update_grade'," + student_id +" )}}";--}}
                    // var url = "";
                    // $('#grade').val(grade_student);
                    // updateGrade(student_id);
                    data +=
                        {{--'<form action="'+url+'"'+'method="post" >'+ @csrf+--}}
                        '<tr><td>' + grades[key]['student_name'] + ' </td>'+
                        // + '<td><input type="hidden" value="hh" name="user_id" id="test_"'+student_id+  ' /></td>' +
                        '<td><input type="hidden" name="user_id" id="user_id1_"'+student_id+ ' data-user_id_'+student_id+
                        ' value="' +student_id+'"></td>' +
                         '<td><input type="hidden" name="course_id" id="course_id_"'+student_id +' value="' +course_id+'"></td>' +
                         '<td> <input type="number" id="grade_"'+student_id+' name="grade" value ="' + grade_student + '">' + '</td>' +
                        '<td> <button class="btn btn-outline-info update_btn" onclick="updateGrade('+student_id+')" > update </button>' +'</td>'
                        +'</tr>';
                }


                table_body.empty();
                table_body.append(data);
            }

        });
    });

    // $i = 0; var array = {};
    // function updateGrade(user_id){
    //     // alert(user_id);
    // //     array[i] = user_id;
    // //    i++;
    // //     return array;

    function updateGrade(user_id) {
        // alert(user_id);
        var student_id1 = 'user_id1_'+user_id;
        // var test = '#user_id1_'+user_id;
        // $(this).data(student_id1);
        console.log( student_id1);
        // console.log($(this).data('user_id_'+user_id));
        // var test =   document.getElementById('test_'+user_id).value ;
        // console.log(test);
        // $(test).val('something');
        // alert($(this).data('user_id_'+user_id));
        var student_id = document.getElementById(student_id1).value;
        // var input = document.getElementById(student_id1);
        // var inputVal = "";
        // if (input) {
        //     inputVal = input.value;
        //     console.log('success');
        // }else
        // console.log('error');
        //
        // var grade1 = document.getElementById('grade_'+user_id).value;
        //
        // var course_id = document.getElementById('course_id_'+user_id).value;
        // // console.log(user_id , "hhhhj", grade1 ,"d", course_id);
        // var data = {
        //     user_id: student_id,
        //     course_id: course_id,
        //     grade: grade1,
        // };
        // console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "{{url('teacher/update/')}}/" + user_id,

            data: data,
            // success:function (){
            //     window;
            // }
        });
    // });
    }

    $(document).on('click', '.add_student', function (e) {
        e.preventDefault();
        var course_id = $(this).data('course_id');
        $('#course_id1').val(course_id);
        // console.log($('#course_id1').val());
        // alert( $('#course_id1').value);
    });


</script>

</body>

</html>
