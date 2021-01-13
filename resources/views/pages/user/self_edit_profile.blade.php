<x-backend-layout>
   <!-- Hero -->
    <div class="bg-image" style="background-image: url('assets/images/photo8@2x.jpg');">
        <div class="bg-black-75">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="assets/images/avatar13.jpg" alt="">
                </div>
                <h1 class="h2 text-white mb-0">Edit Account</h1>
                <h2 class="h4 font-w400 text-white-75">
                    John Parker
                </h2>
                <a class="btn btn-light" href="be_pages_generic_profile.html">
                    <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Profile
                </a>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">User Profile</h3>
            </div>
            <div class="block-content">
                <form action="{{route('user.self.update')}}" method="POST" id="profile-form-id" enctype="multipart/form-data">
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="font-size-sm text-muted">
                                Your account’s vital info. Your username will be publicly visible.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your username.." value="{{$user_data->first_name}}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your name.." value="{{$user_data->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email.." value="{{$user_data->email}}">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your Contact Number.." value="{{$user_data->phone_number}}">
                            </div>
                           <!--  <div class="form-group">
                                <label>Your Avatar</label>
                                <div class="push">
                                    <img class="img-avatar" src="assets/images/avatar13.jpg" alt="">
                                </div>
                                <div class="custom-file"> -->
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <!-- <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="one-profile-edit-avatar">
                                    <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new avatar</label>
                                </div>
                            </div> -->
                            <div class="form-group">
                                 <x-button class="btn btn-alt-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                                    {{ __('Update') }}
                                </x-button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Change Password -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Change Password</h3>
            </div>
            <div class="block-content">
                <form id="password-form-id" action="{{route('update.self.password')}}" method="POST" >
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="font-size-sm text-muted">
                                Changing your sign in password is an easy way to keep your account secure.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="confirm-password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                </div>
                            </div>
                            <div class="form-group">
                                 <x-button class="btn btn-alt-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                                    {{ __('Update') }}
                                </x-button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->


    </div>
    <!-- END Page Content -->
</x-backend-layout>
