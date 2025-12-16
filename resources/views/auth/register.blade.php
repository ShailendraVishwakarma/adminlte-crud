<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header text-center">Register</div>
                <div class="card-body">

                    <form method="POST" action="/register">
                        @csrf

                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button class="btn btn-success btn-block">Register</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="/login">Already have account?</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
