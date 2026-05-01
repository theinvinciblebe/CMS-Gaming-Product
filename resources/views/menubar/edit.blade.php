@extends('layout.main')
@section('menuedit')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Navbar Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">NavItems Update</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @foreach($tbl as $item)
                        <form class="form-horizontal" method="Post" action="/menubar-edit/{{$item->navid}}" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item1:</label>
                                    <input value="{{$item->nav1}}" name="txtNav1" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item2:</label>
                                    <input value="{{$item->nav2}}" name="txtNav2" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item2">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item3:</label>
                                    <input value="{{$item->nav3}}" name="txtNav3" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item3">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item4:</label>
                                    <input value="{{$item->nav4}}" name="txtNav4" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item4">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item5:</label>
                                    <input value="{{$item->nav5}}" name="txtNav5" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item5">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item6:</label>
                                    <input value="{{$item->nav6}}" name="txtNav6" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item6">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item7:</label>
                                    <input value="{{$item->nav7}}" name="txtNav7" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item7">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navbar Item8:</label>
                                    <input value="{{$item->nav8}}" name="txtNav8" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item8">
                                </div>
                                <div class="card-body">
                                    <img src="/image/{{$item->logo}}" width="150" id="imgshow">
                                    <div class="form-group">

                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input value="{{$item->logo}}" name="noPhoto" type="hidden"></input>
                                                <input onchange="previewFile()" type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save" ></i>Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                @endforeach



            </div>
        </div>
    </section>
@endsection
