<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accept Invitation</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Accept Invitation</h5>
                </div>

                <div class="card-body">

                    <p class="text-center">
                        You have been invited as
                        <span class="badge badge-info">
                            {{ $invite->role }}
                        </span>
                    </p>

                    <p class="text-center text-muted">
                        Company:
                        <strong>
                            {{ $invite->company_id ? 'Existing Company' : 'New Company' }}
                        </strong>
                    </p>

                    <hr>

                <form method="POST" action="{{ route('invite.register') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $invite->token }}">

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Enter your name"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                   class="form-control"
                                   value="{{ $invite->email }}"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Create password"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm password"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-success btn-block">
                            Register & Accept Invitation
                        </button>
                    </form>

                </div>

                <div class="card-footer text-center text-muted">
                    URL Shortener System
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
