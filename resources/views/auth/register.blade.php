@extends("layouts.base")


@section("title", "Register")


@section("content")
     <div class="container">
        <div class="row">
            <div class="col-12 offset-md-3 col-md-6">
                <div class="card shadow" style="margin-top: 15vh;">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3">Bimbo CRM</h4>
                        <p style="font-size: 12px" class="text-center text-secondary">Register Now</p>
                         @include("partials.alerts_inc")
                        <form action="{{ route("auth.process-sign-up") }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                             <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                             <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Register</button>
                            </div>

                            <div class="form-group mt-5">
                                <p style="font-size: 12px" class="text-center text-secondary">
                                    Already have an account ? <a href="{{ route("auth.login") }}">Log in</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
