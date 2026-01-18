<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: #f5f5f5;
        }
        .login-box {
            margin-top: 100px;
        }
        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center login-box">

     
        <div class="col-md-4">

            @if(Session::has('error'))
                <div class="alert alert-danger">
                {{Session::get('error')}}
                </div>
            @endif
            
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('login.auth')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                        </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>

                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
