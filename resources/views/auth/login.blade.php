<style>
    .click_here {
        animation: blinker 1s linear infinite;

    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
<x-guest-layout>
    <!-- Page Content -->
    <x-auth-card>
        <div class="hero-static">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <!-- Sign In Block -->
                        <div class="block block-rounded block-themed mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Sign In</h3>
                                <div class="block-options">
                                    @if (Route::has('password.request'))
                                    <a class="btn-block-option font-size-sm" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                    @endif


                                    <!-- For Registration -->
                                    <!-- <a class="btn-block-option" href="{{ route('register') }}" data-toggle="tooltip"
                                       data-placement="left" title="New Account">
                                        <i class="fa fa-user-plus"></i>
                                    </a> -->
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-4 py-lg-5">
                                    <h1 class="h2 mb-1">KodeStudio</h1>
                                    <p class="text-muted">
                                        Welcome, please login.
                                    </p>

                                    <!-- Sign In Form -->
                                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    <form method="POST" action="{{ route('login') }}" id="login-form-id">
                                        @csrf
                                        <div class="py-3">
                                            <div class="form-group">
                                                <x-input id="email" class="form-control form-control-alt form-control-lg" type="email" name="email" :value="old('email')" required autofocus />
                                            </div>
                                            <div class="form-group">
                                                <x-input id="password" class="form-control form-control-alt form-control-lg" type="password" name="password" required autocomplete="current-password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <x-input type="checkbox" class="custom-control-input" id="login-remember" name="login-remember" />
                                                    <x-label class="custom-control-label font-w400" for="login-remember" :value="__('Remember Me')" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-xl-5">
                                                <x-button class="btn btn-block btn-alt-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">
                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Sign In') }}
                                                </x-button>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <x-label class="font-w400" for="terms-and-conditions" :value="__('Terms & Conditions')" />
                                            <a class="click_here" href="{{url('/policy')}}">Click here!</a>
                                        </div>
                                    </form>
                                    <!-- END Sign In Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
            </div>
            <div class="content content-full font-size-sm text-muted text-center">
                <strong>KodeStudio.net</strong> &copy; <span data-toggle="year-copy"></span>
            </div>
        </div>
    </x-auth-card>
    <!-- END Page Content -->
</x-guest-layout>