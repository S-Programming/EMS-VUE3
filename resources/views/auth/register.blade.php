<x-guest-layout>
    <div class="hero-static">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <!-- Sign Up Block -->
                    <div class="block block-rounded block-themed mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Create Account</h3>
                            <div class="block-options">
                                <a class="btn-block-option font-size-sm" href="javascript:void(0)" data-toggle="modal" data-target="#one-signup-terms">View Terms</a>
                                <a class="btn-block-option" href="op_auth_signin.html" data-toggle="tooltip" data-placement="left" title="Sign In">
                                    <i class="fa fa-sign-in-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                <h1 class="h2 mb-1">OneUI</h1>
                                <p class="text-muted">
                                    Please fill the following details to create a new account.
                                </p>

                                <!-- Sign Up Form -->
                                <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _js/pages/op_auth_signup.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signup" action="{{route('register')}}" method="POST" id="register-form-id">
                                    @csrf
                                    <div class="py-3">
                                        <div class="form-group">
                                            <x-input type="text" class="form-control form-control-lg form-control-alt" id="first_name" name="first_name" placeholder="First Name" autofocus/>
                                        </div>
                                        <div class="form-group">
                                            <x-input type="text" class="form-control form-control-lg form-control-alt" id="last_name" name="last_name" placeholder="Last Name"/>
                                        </div>
                                        <div class="form-group">
                                            <x-input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" placeholder="Email"/>
                                        </div>
                                        <div class="form-group">
                                            <x-input type="tel" class="form-control form-control-lg form-control-alt" id="phone" name="phone" placeholder="Phone Number"/>
                                        </div>
                                        <div class="form-group">
                                            <x-input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Password"/>
                                        </div>
                                        <div class="form-group">
                                            <x-input type="password" class="form-control form-control-lg form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"/>
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signup-terms" name="signup-terms">
                                                <label class="custom-control-label font-w400" for="signup-terms">I agree to Terms &amp; Conditions</label>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xl-5">
                                            <button type="submit" class="btn btn-block btn-alt-success" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id"
                                            id="validation-span-id">
                                                <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign Up Form -->
                            </div>
                        </div>
                    </div>
                    <!-- END Sign Up Block -->
                </div>
            </div>
        </div>
        <div class="content content-full font-size-sm text-muted text-center">
            <strong>OneUI 4.8</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
    <!-- END Page Content -->
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card> --}}
</x-guest-layout>
