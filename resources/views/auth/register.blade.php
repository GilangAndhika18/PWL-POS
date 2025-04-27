<!DOCTYPE html>
 <html lang="en">
 
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Register</title>
 
     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
     <!-- icheck bootstrap -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
 </head>
 
 <body class="hold-transition register-page">
     <div class="register-box">
         <div class="register-logo">
             <a href="{{ url('/') }}"><b>Admin</b>LTE</a>
         </div>
 
         <div class="card">
             <div class="card-body register-card-body">
                 <p class="login-box-msg">Register a new membership</p>
 
                 <form action="{{ url('/register') }}" method="POST">
                     @csrf
                     <div class="input-group mb-3">
                         <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                         <div class="input-group-append">
                             <div class="input-group-text"><span class="fas fa-user"></span></div>
                         </div>
                     </div>
 
                     <div class="input-group mb-3">
                         <input type="text" class="form-control" name="username" placeholder="Username" required>
                         <div class="input-group-append">
                             <div class="input-group-text"><span class="fas fa-user-tag"></span></div>
                         </div>
                     </div>
 
                     <div class="input-group mb-3">
                         <input type="password" class="form-control" name="password" placeholder="Password" required>
                         <div class="input-group-append">
                             <div class="input-group-text"><span class="fas fa-lock"></span></div>
                         </div>
                     </div>
 
                     <div class="input-group mb-3">
                         <select class="form-control" name="level_id" required>
                             <option value="" disabled selected>Pilih Level</option>
                             @foreach ($level as $item)
                                 <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                             @endforeach
                         </select>
                         <div class="input-group-append">
                             <div class="input-group-text">
                                 <span class="fas fa-users-cog"></span>
                             </div>
                         </div>
                     </div>
 
 
                     <div class="row">
                         <div class="col-12">
                             <button type="submit" class="btn btn-primary btn-block">Register</button>
                         </div>
                     </div>
                 </form>
 
                 <div class="mt-3 text-center">
                     <a href="{{ url('/login') }}" class="text-center">I already have a account</a>
                 </div>
             </div>
         </div>
     </div>
 
     <!-- Scripts -->
     <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
     <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
 </body>
 
 </html>