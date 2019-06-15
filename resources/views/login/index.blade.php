<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Login</title>
    @foreach($websettings as $webset)
    
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="assets/dist/css/sb-admin-2.css" rel="stylesheet">
    
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">Login Admin</h3>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}

                    </div>
                    
                    @endif
                        @if ($errors->first('kodecap'))
                      <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Maaf, Kode Captcha Salah
                    </div>
                  @endif
                        <form role="form" method="post" action="login/masuk">
                            <fieldset>
                            	{{csrf_field()}}
                            	<div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" value="" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" id="loginpass" required>
                                </div>
                                <p class="form-row">
                             <label class="inline" for="rememberme">
                                <input type="checkbox" onclick="tampilsandi()"> Tampilkan Sandi
                            </label>
                            </p>
                                <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-success" id="refresh"><i class="fa fa-refresh"></i></button>
                            </div><br>
                            <div class="form-group">
                                    <input class="form-control" placeholder="Kode Captcha" name="kodecap" type="text" required>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Login">
                                <a href="{{url('/')}}" class="btn btn-lg btn-primary btn-block">
                                    Website Saya
                                </a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        function tampilsandi() {
    var x = document.getElementById("loginpass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
$('#refresh').click(function(){
  $.ajax({
     type:'GET',
     url:'refreshcaptcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
</script>
</body>

</html>
