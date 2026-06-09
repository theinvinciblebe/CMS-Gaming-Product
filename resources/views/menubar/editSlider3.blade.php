@extends('dashboard-layout.main')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider Items</h1>
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
                            <h3 class="card-title">SliderItems Update</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @foreach($tbl as $item)
                            <form class="form-horizontal" method="Post" action="/menubar-editSlider3/{{$item->navid}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">White Title:</label>
                                        <input value="{{$item->whiteTitle3}}" name="txtWhite3" type="text" class="form-control" id="exampleInputEmail1" placeholder="White Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Blue Title:</label>
                                        <input value="{{$item->blueTitle3}}" name="txtBlue3" type="text" class="form-control" id="exampleInputEmail1" placeholder="Blue Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description:</label>
                                        <input value="{{$item->description3}}" name="txtDesc3" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item3">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Button title:</label>
                                        <input value="{{$item->btnTitle3}}" name="txtBtn3" type="text" class="form-control" id="exampleInputEmail1" placeholder="Navbar Item4">
                                    </div>
                                    <div class="card-body">
                                        <img src="/image/{{$item->sliderImage3}}" width="150" id="imgshow">
                                        <div class="form-group">

                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input value="{{$item->sliderImage3}}" name="noPhoto" type="hidden"></input>
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
