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
            <p > the best student </p>
        </div>
        </div>

</nav>

<br>
<div class="card-group">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group-card">
            </div>
<div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">student</th>
                    <th scope="col">grades</th>
                </tr>
                </thead>
                <tbody>
                @foreach($best as $bestdata)
                    <tr>
                        <td>{{$bestdata->user->name}}</td>
                        <td>{{$bestdata->grade}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
</div>
        </div>
    </div>
    </div>
</body>
</html>
