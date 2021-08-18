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
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('css/table.css') }}" rel="stylesheet" type="text/css"/>

    <title>student</title>
</head>

<body>
<!-- {{-- <div class="container "> --}} -->
<ul>

    <li><a class="btn" style="padding:14px 16px;" href="{{route('add_course')}}">تسجيل المساقات</a></li>
    <li><a class="btn" style="padding:14px 16px;" href="{{route('view_course')}}">المساقات المسجلة</a></li>
    <li style="float:right;"><a href="{{ route('profile_student') }}">الصفحةالرئيسية</a></li>
</ul>
<div class="container">
    <div class="row container   justify-content-center">
        <div class="col-md-6">
            <div class="row m-l-1 m-r-1">


                <table>
                    <thead>
                    <tr>
                        <th> teacher name</th>
                        <th> course name</th>
                        <th> gardes</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    {{dd($grades)}}--}}
                    @foreach ($grades as $grade)
                        <tr>
                            @foreach ($user->courses as $course)
{{--                                @dd($course);--}}
                                @if($course->id==$grade->course_id)
                            <td>{{ $course->user->name }}</td>
                            <td>{{ $course->name}}</td>
                                    <td>{{$grade->grade}}</td>
                                @endif
                            @endforeach


                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</body>
</html>
