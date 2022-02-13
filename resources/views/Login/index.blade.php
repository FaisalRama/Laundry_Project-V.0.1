{{-- Login --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Login to SaLaundry</title>

    {{-- CSS LOCALE --}}
    <link href="{{ asset('assets') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/build/css/custom.min.css" rel="stylesheet">
        
<script>(function(w,d){!function(a,e,t,r,z){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zarazData.tracks=[],a.zaraz={deferred:[]};var s=e.getElementsByTagName("title")[0];a.zarazData.c=e.cookie,s&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),//
a.dataLayer=a.dataLayer||[],a.zaraz.track=(e,t)=>{for(key in a.zarazData.tracks.push(e),t)a.zarazData["z_"+key]=t[key]},a.zaraz._preSet=[],a.zaraz.set=(e,t,r)=>{a.zarazData["z_"+e]=t,a.zaraz._preSet.push([e,t,r])},a.dataLayer.push({"zaraz.start":(new Date).getTime()}),a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r);z.defer=!0,z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);</script></head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
            <div class="login_wrapper">
            <div class="animate form login_form">
    <section class="login_content">

    {{-- FORM LOGIN --}}
<form action="" method="POST">
    @csrf

    {{-- Notification --}}
    {{-- If Success Regist --}}
    @if(session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- If Failed to Login --}}
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

<h1>Login Form</h1>
<div>
    <input name="email" id="email" type="text" placeholder="name@example.com" required 
    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div>
<input name="password" type="password" class="form-control" placeholder="Password" required />
</div>
<div>
<button type="submit" class="btn btn-default submit">Log In</button>
{{-- <a class="btn btn-default submit" href="home/index.blade.php">Log in</a> --}}
<a class="reset_pass" href="#">Lost your password?</a>
</div>
<div class="clearfix"></div>
<div class="separator">
<p class="change_link">New to site?
<a href="#signup" class="to_register"> Create Account </a>
</p>
<div class="clearfix"></div>
<br />
<div>
<h1><i class="fa fa-paw"></i> SaLaundry V.0.0 </h1>
<p>©2022 All Rights Reserved. SaLaundry is the best Laundry on Cianjur. Privacy and Terms</p>
</div>
</div>
</form>
</section>
</div>

{{-- Register --}}
<div id="register" class="animate form registration_form">
<section class="login_content">
<form action="/" method="POST">
    @csrf
<h1>Create Account</h1>
<div>
    <input type="text" name="name" id="name" 
    class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" />
    @error('name')
        <div class="invalid-feedback">
            Please fill in the name first!
        </div>
    @enderror
</div>
<div>
    <input type="text" name="username" id="username" 
    class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}" />
    @error('username')
        <div class="invalid-feedback">
            the username cannot be less than 3 and more than 300
        </div>
    @enderror
</div>
<div>
    <input type="email" name="email" id="email" 
    class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" />
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div>
    <input type="password" name="password" id="password" 
    class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
    @error('password')
        <div class="invalid-feedback">
            The password cannot be less than 5 and more than 100
        </div>
    @enderror
</div>
<div>
    <input type="text" name="outlet_id" id="outlet_id" 
    class="form-control @error('outlet_id') is-invalid @enderror" placeholder="outlet_id" />
    @error('outlet_id')
        <div class="invalid-feedback">
            the outlet_id is required
        </div>
    @enderror
</div>
<div>
    <select id="role" name="role" required="required" class="form-control @error('role') is-invalid @enderror" 
    placeholder="role"  >
        <option selected disabled >Pilih Role Anda !</option>
        <option value="admin">admin</option>
        <option value="kasir">kasir</option>
        <option value="owner">owner</option>
    </select>
    @error('role')
        <div class="invalid-feedback">
            Just choose 1 role
        </div>
    @enderror
</div>
<br>
<div>
    <button type="submit" class="btn btn-default submit">Submit</button>
</div>
    <div class="clearfix"></div>
    <div class="separator">
        <p class="change_link">Already a member ?
            <a href="#signin" class="to_register"> Log in </a>
        </p>
            <div class="clearfix"></div>
    <br/>
        <div>
            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
        </div>
    </div>
</form>

    </section>
            </div>
        </div>
    </div>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"6d8202e6c9333591","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}' crossorigin="anonymous"></script>
</body>
</html> 
