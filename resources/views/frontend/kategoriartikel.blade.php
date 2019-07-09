@extends('layout/masteruser')

    @section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    @endsection
   
    @section('logo')
    @foreach($websettings as $webset)
    <a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}" alt="" style="width:70%;"></a>
    @endforeach
    @endsection
    
    @section('content')

<div class="content">
    <div class="container">
        <br>
        @foreach($kategorinama as $kat)
        <h2 class="new text-center">ARTIKEL BERKATEGORI "{{$kat->nama}}"</h2>
        @endforeach
        <br>
        <div class="col-md-10">
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
            
        </div>
        <div class="col-md-2">
             <div class="single-bottom">
                        <h4>Kategori</h4>
                        <ul>
                             @foreach($kategori as $kategori)
                            <li>
                                <a href="{{url('list-artikel/'.$kategori->id.'/kategori')}}">
                                    <label for="brand"><span></span>{{$kategori->nama}}</label>
                                </a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
        </div>
        </div>
</div>
   @endsection
    
    