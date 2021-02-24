<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Technology Stack</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('confirm.add.technology.stack') }}" id="role-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
                                <div class="form-group">
                                    <!-- <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden"
                                             name="id"/> -->
                                    <label for="role">&nbsp Technology Stack</label>
                                    <x-input id="role" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="technology_stack" required
                                             autofocus/>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="last_name">&nbsp Last Name</label>
                                    <x-input id="last_name" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="last_name" value="{{$user_data->last_name??''}}" required/>
                                </div> -->
                            </div>
                            <!-- <div class="py-3">
                                <div class="form-group">
                                    <label for="roles">&nbsp Role</label>
                                    {!!$roles_dropdown??''!!}
                                </div>
                                <div class="form-group">
                                    <label for="email">&nbsp Email</label>
                                    <x-input id="email" class="form-control form-control-alt form-control-lg"
                                             type="email"
                                             name="email" value="{{$user_data->email??''}}" required/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">&nbsp Phone Number</label>
                                    <x-input id="phone_number" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="phone_number" value="{{$user_data->phone_number??''}}" required/>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-modal>
