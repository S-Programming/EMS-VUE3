<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add User</h3>
    </x-slot>
    <x-slot name="modal_content">
        <form method="POST" action="{{ route('confirm.adduser') }}" id="login-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
            @csrf
            <div class="py-2">
                <div class="form-group">
                    <x-input id="first_name" class="form-control form-control-alt form-control-lg" type="text" name="first_name" placeholder="First Name" :value="old('first_name')" required autofocus />
                </div>
                <div class="form-group">
                    <x-input id="last_name" class="form-control form-control-alt form-control-lg" type="text" name="last_name" placeholder="Last Name" :value="old('last_name')" required autofocus />
                </div>
            </div>
            {{$rolesDropDown??''}}
            <div class="py-2">
                <div class="form-group">
                    <x-input id="email" class="form-control form-control-alt form-control-lg" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                </div>
                <div class="form-group">
                    <x-input id="phone_number" class="form-control form-control-alt form-control-lg" type="text" name="phone_number" placeholder="Phone Number" :value="old('phone_number')" required autofocus />
                </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel</button>
                <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id"
                              id="validation-span-id" >
                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-slot>
</x-modal>
