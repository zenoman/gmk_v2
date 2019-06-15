@extends('layout.master')
@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slider</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-lg-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
                    <a href="slider/create" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Slider
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>judul</th>
                                        <th>foto</th>
                                        <th class="text-center">Aksi</th>
                                        <!--th>Level</th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($sliders as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                        <td>{{$no}}</td>
                                       <td>{{$row->judul}}</td>
                                        <td>{{$row->foto}}</td>
                                        <td class="text-center tooltip-demo">
                                           

                                        <a href="{{url('slider/'.$row->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-wrench"></i> Edit</a>

                                        <a onclick="return confirm('Hapus Data ?')" href="{{url('slider/'.$row->id.'/delete')}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i> Hapus</a>                                        
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            <div class="text-right">
                          <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>  
                        </div>
                        </div>  
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>

        @endsection

         @section('js')
        
        @endsection
