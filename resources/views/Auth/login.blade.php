<x-layouts.auth>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-sm" style="width: 360px;">
            <h3 class="text-center mb-3">Login</h3>
            <form method="POST" action="{{ route('login.in') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           placeholder="Enter email"
                           value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           placeholder="Enter password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </form>

            <a href="{{route("register")}}" class="mt-3 d-block text-center text-primary fw-bold">Don't have an account?</a>
        </div>
    </div>

</x-layouts.auth>
