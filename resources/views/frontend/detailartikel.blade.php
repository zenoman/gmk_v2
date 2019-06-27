@extends('layout/masteruser')

    @section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    @endsection
   
    @section('logo')
    @foreach($websettings as $webset)
    <a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}" alt="" ></a>
    @endforeach
    @endsection
    
    @section('content')

<div class="content">
    <div class="container">
        <br>
        <h2 class="new text-center">DETAIL ARTIKEL</h2>
        <br>
        <div class="col-md-10">
            @foreach($artikel as $art)
            <div class="content-bottom">
                <div class="col-md-12 latter">
                    <img src="{{asset('img/artikel/'.$art->gambar)}}" alt="" width="100%">
                    <br><br>
                    <h6>{{$art->judul}}</h6>
                    <br><br>

                    <p>{!!$art->isi!!}</p>
                    <br>
                    <span class="label label-primary" style="background-color: #fa7455;">
                        <i class="fa fa-eye"></i> {{$art->dilihat}}
                    </span>&nbsp;
                    <span class="label label-primary" style="background-color: #fa7455;">
                        <i class="fa fa-calendar"></i> {{$art->tgl}}
                    </span>
                    &nbsp;
                    <span class="label label-primary" style="background-color: #fa7455;">
                        <i class="fa fa-tag"></i> {{$art->nama}}
                    </span>
                    
                    <br><br>
                    <div class="text-center">
                        <a href="#" onclick="history.go(-1)" class="tombol" style="color: white;">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                        
                    </div>
                    <div class="clearfix"> </div>
                </div>
         
                    <div class="clearfix"> </div>
            </div>
                   @endforeach
                   <br>
        </div>
        <div class="col-md-2">
             <div class="single-bottom">
                        <h4>Kategori</h4>
                        <ul>
                             @foreach($kategori as $kategori)
                            <li><label for="brand"><span></span>{{$kategori->nama}}</label></li>
                            @endforeach
                            
                        </ul>
                    </div>
        </div>
        </div>
</div>
   @endsection
    
    