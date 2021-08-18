<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css	">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/table.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">


    <title>student</title>
</head>

<body>
<!-- {{-- <div class="container "> --}} -->
<ul>
    <li><a class="btn" style="padding:14px 16px;" href="{{route('view_grade')}}">علامات المساقات</a></li>
    <li><a class="btn" style="padding:14px 16px;" href="{{ route('view_course') }}">المساقات المسجلة</a></li>
    <li style="float:right;"><a href="{{ route('profile_student') }}">الصفحة الرئيسية</a></li>
</ul>
<div class="page-content page-container">
    <div class="padding">
        <div class="container">
            <div class="row container justify-content-center">
                <div class="col-md-4">
                    {{--            <div class="row m-l-2 m-r-2">--}}
                    <div class="card-header">
                        <form action="{{route('add_course_teacher')}}" method="post">
                            {{csrf_field()}}
                            <div class="card-block mr-2">
                                <select class="form-control form-control-lg" name="course_id"
                                        id="course_id">
                                    @foreach ($courses as $course)
                                        <option value={{ $course->id }}>{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-block mr-md-0">
                                <label> selected the teacher </label>
                                <input type="text" class="form-control form-control-lg" name="user_id" id="user_id"
                                       disabled>
                            </div>

                            <button type="submit" class="btn btn-primary">add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $('#course_id').on('change', function () {
        var course_id = $("#course_id :selected").val();
        $.ajax({
            type: "get",
            url: "{{url('students/getTeacher/')}}/" + course_id,

            success: function (data) {
                var name = data.name;
                $('#user_id').val(name);

            }
        });
    });
</script>
</body>

</html>
