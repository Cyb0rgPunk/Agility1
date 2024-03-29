<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agility</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?php echo base_url('/public/plugins/fontawesome-free/css/all.min.css')?>">

    <link rel="stylesheet" href="<?php echo base_url('/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">

    <link rel="stylesheet" href="<?php echo base_url('/public/dist/css/adminlte.min.css?v=3.2.0')?>">
    <script nonce="f61021c5-5e4a-4bdb-b94b-08f45d6ed168">
    (function(w, d) {
        ! function(a, e, t, r, z) {
            a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = {
                deferred: []
            };
            var s = e.getElementsByTagName("title")[0];
            s && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a
                .zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a
                .zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a
                .zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.dataLayer = a
                .dataLayer || [], a.zaraz.track = (e, t) => {
                    for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key]
                }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => {
                    a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r])
                }, a.dataLayer.push({
                    "zaraz.start": (new Date).getTime()
                }), a.addEventListener("DOMContentLoaded", (() => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r);
                    z.defer = !0, z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(
                        a.zarazData))), t.parentNode.insertBefore(z, t)
                }))
        }(w, d, 0, "script");
    })(window, document);
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Agility </b></a>
        </div>
        <?php if(session('msg')):?>
        <div class="alert alert-<?=session('msg.type')?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <?=session('msg.body')?>
        </div>
        <?php endif;?>
        
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar sesion</p>
                <form action="<?=site_url('/checkLog')?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name='email' class="form-control" placeholder="Email" value="<?=old('email')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <p style="color:red;"><?=session('errors.email')?></p>
                    <div class="input-group mb-3">
                        <input type="password" name='password' class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div><br>
                    </div>
                    <p style="color:red;"><?=session('errors.password')?></p>
                    <div class="row">                       

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <br>    
                        <p class="mb-1">
                            <a href="forgot-password.html">I forgot my password</a>
                        </p>

                    </div>

            </div>
        </div>
<!-- jQuery -->
<script src="<?php echo base_url('/public/plugins/jquery/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('/public/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('/public/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
</body>

</html>