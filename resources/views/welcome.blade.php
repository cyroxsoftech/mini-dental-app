<x-guest-layout title="Access Clinic Portal">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="my-5 border-0 shadow-lg card o-hidden">
                <div class="p-0 card-body">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="mb-2 text-gray-900 h4 text-uppercase">Access Clinic Portal</h1>
                                    <p class="mb-4">Enter your clinic ID before proceeding!</p>
                                </div>
                                <form method="post" action="{{ route('clinic.verify') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('clinicId') is-invalid  @enderror"
                                            id="clinic-reference"
                                            placeholder="250125-1003" name="clinicId">
                                            @error('clinicId')
                                                <span class="mt-5 text-danger font-weight-bold">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-block">
                                       Continue
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
