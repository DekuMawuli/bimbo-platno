@extends("layouts.base")


@section("title", "Sign In")


@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12 offset-md-3 col-md-6">
                <div class="card shadow" style="margin-top: 25vh;">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3">Bimbo CRM</h4>
                        <p style="font-size: 12px" class="text-center text-secondary">Manage You Customers with Ease</p>
                        @include("partials.alerts_inc")
                        <form action="{{ route("auth.process-sign-in") }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                             <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Login</button>
                            </div>

                            <div class="form-group mt-5">
                                <p style="font-size: 12px" class="text-center text-secondary">
                                    Need an account ? <a href="{{ route("auth.signup") }}">Register</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
