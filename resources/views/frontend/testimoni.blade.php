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
        <h2 class="new text-center">Testimoni</h2>
        <br>
        <div class="col-md-12">
            @foreach($artikel as $art)
        <div class="col-md-6">
            <div class="content-bottom">
                <div class="col-md-12 latter">
                    <img src="{{asset('img/artikel/'.$art->gambar)}}" alt="" width="100%">
                    <br><br>
                    <h6>{{$art->judul}}</h6>
                    <br><br>

                    <p>{!!substr($art->isi,0,200)!!}</p>
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
                    
                    <br>
                    <div class="text-center">
                        <a href="{{url('/detail-artikel/'.$art->link)}}" class="btn btn-block tombol" style="color: white;">
                        Lanjut Baca
                    </a>
                        
                    </div>
                    <div class="clearfix"> </div>
                </div>
         
                    <div class="clearfix"> </div>
            </div>
        </div>
                   @endforeach
            <div class="col-md-12 col-sm-12 text-center">
                <br>
                    {{ $artikel->links() }}
                </div>
        </div>
        </div>
</div>
   @endsection
    
    