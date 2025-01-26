<x-guest-layout title="Sign up">
    <div class="my-5 border-0 shadow-lg card o-hidden">
        <div class="p-0 card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="mb-4 text-gray-900 h4">Create an Account!</h1>
                        </div>
                        <form class="user">
                            <div class="form-group row">
                                <div class="mb-3 col-sm-12 mb-sm-0">
                                    <input type="text" class="form-control " id="exampleFirstName"
                                        placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control " id="exampleInputEmail"
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group row">
                                <div class="mb-3 col-sm-6 mb-sm-0">
                                    <input type="password" class="form-control "
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control "
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                </div>
                            </div>
                            <a href="javascript:;" class="btn btn-primary btn-block">
                                Register Account
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('clinic.password.request', clinic('id')) }}">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('clinic.login', clinic('id')) }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
