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
        <h2 class="new text-center">CARA BELANJA</h2>
        <br>
        <div class="col-md-12">
            @foreach($websettings as $web)
            <div class="content-bottom">
                <div class="col-md-12 latter">
                    <div class="text-center">
                        <img src="{{asset('img/web/carabelanja.jpg')}}" alt="" width="70%">    
                    </div>
                    
                    <br>
                    <div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <p>{!!$web->peraturan!!}</p>        
                        </div>
                        <div class="col-md-2">
                        </div>
                        
                    </div>
                    <br>
                    <div class="clearfix"> </div>
                </div>
         
                    <div class="clearfix"> </div>
            </div>
                   @endforeach
                   <br>
        </div>
        </div>
</div>
   @endsection
    
    