@extends('layout.main')
@section('menuedit')

<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1>Navbar Items</h1>
                </div>
            </div>
        </div>
</section>
        <!-- Edit NavItem -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" align="center">
                    <thead>
                    <tr align="center" style="background-color:  Skyblue;" style="color: Black;">
                        <th>Navbar Logo</th>

                        <th>NavItem 1</th>
                        <th>NavItem 2</th>
                        <th>NavItem 3</th>
                        <th>NavItem 4</th>
                        <th>NavItem 5</th>
                        <th>NavItem 6</th>
                        <th>NavItem 7</th>
                        <th>NavItem 8</th>


                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tbl as $item)
                    <tr align="center">
                        <td><img src="/image/{{$item->logo}}" height="70" width="150" /></td>

                        <td>{{$item->nav1}}</td>
                        <td>{{$item->nav2}}</td>
                        <td>{{$item->nav3}}</td>
                        <td>{{$item->nav4}}</td>
                        <td>{{$item->nav5}}</td>
                        <td>{{$item->nav6}}</td>
                        <td>{{$item->nav7}}</td>
                        <td>{{$item->nav8}}</td>


                        <td>
                        <div class="dropdown">
                        <a class="btn btn-primary"
                           href="/menubar-edit/{{ $item->navid }}"
                                style="width: 120px;">
                                <i class="fa fa-edit" style="font-size:20px;color:white; pointer:cursor:pointer"></i>
                                Edit
                        </a>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                        </tbody>
                </table>

            </div>
            <!-- /.card-body -->

        </div>

        <!-- Edit Slider -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-12">
            <div class="col-sm-12">
                <h1>Slider Items</h1>
            </div>
        </div>
    </div>
</section>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" align="center">
                    <thead>
                    <tr align="center" style="background-color:  yellow;" style="color: Black;">
                        <th>Slider Image</th>

                        <th>White Title</th>
                        <th>Blue Title</th>
                        <th>Button Title</th>
                        <th width="300">Description</th>


                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tbl as $item)
                        <tr align="center">
                            <td><img src="/image/{{$item->sliderImage}}" height="70" width="100" /></td>

                            <td>{{$item->whiteTitle}}</td>
                            <td>{{$item->blueTitle}}</td>
                            <td>{{$item->btnTitle}}</td>
                            <td>{{$item->description}} </td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary"
                                       href="/menubar-editSlider/{{ $item->navid }}"
                                       style="width: 120px;">
                                        <i class="fa fa-edit" style="font-size:20px;color:white; pointer:cursor: pointer"></i>
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->

        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" align="center">
                    <thead>
                    <tr align="center" style="background-color:  #2ecc71;" style="color: white;">
                        <th>Slider Image</th>

                        <th>White Title</th>
                        <th>Blue Title</th>
                        <th>Button Title</th>
                        <th width="300">Description</th>


                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tbl as $item)
                        <tr align="center">
                            <td><img src="/image/{{$item->sliderImage2}}" height="70" width="100" /></td>

                            <td>{{$item->whiteTitle2}}</td>
                            <td>{{$item->blueTitle2}}</td>
                            <td>{{$item->btnTitle2}}</td>
                            <td>{{$item->description2}}</td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary"
                                       href="/menubar-editSlider2/{{ $item->navid }}"
                                       style="width: 120px;">
                                        <i class="fa fa-edit" style="font-size:20px;color:white; pointer:cursor:pointer"></i>
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->

        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" align="center">
                    <thead>
                    <tr align="center" style="background-color:  #00a379;" style="color: Black;">
                        <th>Slider Image</th>

                        <th>White Title</th>
                        <th>Blue Title</th>
                        <th>Button Title</th>
                        <th width="300" >Description</th>


                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tbl as $item)
                        <tr align="center">
                            <td><img src="/image/{{$item->sliderImage3}}" height="70" width="100" /></td>

                            <td>{{$item->whiteTitle3}}</td>
                            <td>{{$item->blueTitle3}}</td>
                            <td>{{$item->btnTitle3}}</td>
                            <td>{{$item->description3}}</td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary"
                                       href="/menubar-editSlider3/{{ $item->navid}}"
                                       style="width: 120px;">
                                        <i class="fa fa-edit" style="font-size:20px;color:white; pointer:cursor:pointer"></i>
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->


                </div>
            </div>
        </div>
    </section>
@endsection
