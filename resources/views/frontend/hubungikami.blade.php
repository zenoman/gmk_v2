@extends('layout.masteruser')

    @section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    @endsection
    @section('logo')
     @foreach($websettings as $webset)
     <h1><a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}"></a></h1>
    @endforeach
    @endsection               
    
    @section('content')

   <div class="container">
        <div class="contact">
    <h2>HUBUNGI KAMI</h2>
                <div class="contact-in">
                    <hr>
                    @foreach($websettings as $webset)
                    <div class=" col-md-12 text-center">
                        {{$webset->keterangan}}
                    </div>
                    <br>
                    <hr>
                    <hr>
                <div class=" col-md-4">

                       <div class="well well-xl text-center">
                        <p  style="font-size: 60px;"><i class="fa fa-phone"></i></p>
                        <h4>
                       Admin 1 : {{$webset->kontak1}}</h4>
                        </div>
                    </div>
                    <div class=" col-md-4">

                       <div class="well well-xl text-center">
                        <p  style="font-size: 60px;"><i class="fa fa-phone"></i></p>
                        <h4>
                       Admin 2 : {{$webset->kontak2}}</h4>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="well well-xl text-center">
                        <p  style="font-size: 60px;"><i class="fa fa-phone"></i></p>
                        <h4>
                       Admin 3 : {{$webset->kontak3}}</h4>
                        </div>
                    </div>
                      <div class="clearfix"></div>
                      @endforeach
                 </div>
                
            </div>
    </div>
        <div class="map">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d505145.6949089349!2d115.07157704999999!3d-8.455471450000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd22f7520fca7d3%3A0x2872b62cc456cd84!2sBali%2C+Indonesia!5e0!3m2!1sen!2sin!4v1418170815897"></iframe>
                </div>
            <div class="text-center">
                <br><br>
                <p><i class="fa fa-book"></i> {{$webset->alamat}}</p>
            </div>
    @endsection
    