<x-guest-layout title="Login">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="my-5 border-0 shadow-lg card o-hidden">
                <div class="p-0 card-body">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="mb-4 text-gray-900 h4">{{ tenant('name') }}</h1>
                                </div>
                                <form method="post" action="{{ route('clinic.login.store', clinic('id')) }}">
                                    @csrf
                                    <div class="mt-5 row">
                                        <div class="mx-auto col-12 d-block">
                                            @if (session('success'))
                                                <x-alert type="success">
                                                    {{ __(session('success')) }}
                                                </x-alert>
                                            @endif
                                            <div class="mb-4 form-group">
                                                <x-role-selector name="role"  :selectedRole="$role"/>
                                            </div>
                                            @error('role')
                                                <span class="d-block alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="mb-4 input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <input name="email" type="email"
                                                    class="form-control text-dark @error('email') is-invalid @enderror"
                                                    placeholder="Email Address"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                            @error('email')
                                                <span class="d-block alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="mb-4 input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                                <input name="password" type="password"
                                                    class="form-control text-dark @error('password') is-invalid @enderror"
                                                    placeholder="Password" required>
                                            </div>
                                            @error('password')
                                                <span class="d-block alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
            
                                            <div class="flex-row row d-flex justify-content-between align-items-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox">
                                                            <input name="remember" type="checkbox" value="1"
                                                                class="custom-control-input" />
                                                            <span class="custom-control-label text-gray-dark">
                                                                <span class="ml-1">{{ __('Remember me') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="mt-3 row">
                                                <div class="col-12">
                                                    <button type="submit" class="px-4 btn btn-primary btn-block">
                                                        {{ __('Login') }}
                                                    </button>
                                                </div>
                                                <div class="text-center col-12">
                                                    <a href="{{ route('clinic.password.request', clinic('id')) }}"
                                                        class="px-0 btn btn-link box-shadow-0 text-gray-dark">
                                                        {{ __('Forgot password?') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
            
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('clinic.password.request', clinic('id')) }}">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('clinic.register', clinic('id')) }}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-guest-layout>