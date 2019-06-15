@extends('layout.master')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">setting</h1>

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
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Data settings
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        
                                        <th>Nama Web</th>
                                        <th>Kontak1</th>
                                        <th>Kontak2</th>
                                        <th>Kontak3</th>
                                        <th>Email</th>
                                        <th class="text-center">Aksi</th>
                                        <!--th>Level</th-->
                                    </tr>
                                </thead>
                                <tbody>



                                    <tr>
                                    <?php $i = 1;?>
                                    @foreach($setting as $row)
                                    <?php $no = $i++;?>
                                        <td>{{$row->webName}}</td>
                                        <td>{{$row->kontak1}}</td>
                                        <td>{{$row->kontak2}}</td>
                                        <td>{{$row->kontak3}}</td>
                                        <td>{{$row->email}}</td>
                                        <td class="text-center">
                                        <a href="setting/{{$row->id}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-wrench"></i> Edit</a>                                       
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
@endsection