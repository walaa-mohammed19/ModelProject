<!doctype html>
<html lang="en">
    {{-- @dd(2) --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css	">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <title>student</title>
</head>
<body>
<!-- {{--<div class="container ">--}} -->
<ul>
    <li><a class="btn" style="padding:14px 16px;" href="{{route('view_grade')}}">علامات المساقات</a></li>
    <li><a class="btn" style="padding:14px 16px;" href="{{route('add_course')}}">تسجيل المساقات</a></li>
    <li><a class="btn" style="padding:14px 16px;" href="{{route('view_course')}}">المساقات المسجلة</a></li>
    <li style="float:right;"><a href="{{route('logout_user')}}">خروج</a></li>
</ul>
<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-8 col-md-16">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-md-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-20">
                                    <img width="100px" class="img-radius" src="{{auth('web')->user()->image}}" alt="">
                                </div>
                                <h6 style="color:#843534" class="f-w-750">{{auth('web')->user()->name}}</h6>
                            <!-- {{--                             <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>--}} -->
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-750">Information</h6>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p class="m-b-12 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">{{auth('web')->user()->email}}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-12 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400">{{auth('web')->user()->phone}}</h6>
                                    </div>
                                </div>
                                <div class="row m-b-10 m-t-40 p-b-5 b-b-default f-w-600">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600"></p>
                                        <h6 class="text-muted f-w-400"></h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
