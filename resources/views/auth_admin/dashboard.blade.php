<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="navbar-brand">
            <p > admin page </p>
        </div>
    </div>
</nav>
<br>
<div class="card-group">
    <div class="row justify-content-center">
        <div class="col-md-2">
                <a href="{{route('index_teacher')}}" class="btn btn-info"style="margin:2px;" > Teacher</a>
                <a href="{{route('index_student')}}" class="btn btn-info" style="margin:2px;"> Student</a>
                <a href="{{route('index_course')}}" class="btn btn-info" style="margin:2px;"> Courses</a>

                <a href="{{route('index_grade')}}" class="btn btn-info" style="margin:2px;" > best student </a>

                <a href="{{route('logout_admin')}}" class="btn btn-info" style="margin:2px;">logout</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

