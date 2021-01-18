<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Update User Checkin History</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('user.checkin.update') }}" id="login-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
                                <div class="form-group">
                                    <x-input id="id" class="form-control form-control-alt form-control-lg" type=""
                                             name="id" value="{{$user_checkin_data->id??0}}"/>
                                    <label for="checkin-time">&nbsp Check In Time</label>
                                    <x-input id="checkin-time" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="checkin-time" value="{{$user_checkin_data->checkin??''}}" required
                                             autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-time">&nbsp Check Out Time</label>
                                    <x-input id="checkout-time" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="checkout-time" value="{{$user_checkin_data->checkout??''}}" required/>
                                </div>
                            </div>
                            <div class="py-3">
                                {{-- <div class="form-group">
                                    <label for="roles">&nbsp Role</label>
                                    {!!$roles_dropdown??''!!}
                                </div> --}}
                                <div class="form-group">
                                    <label for="email">&nbsp Description</label>
                                    <x-input id="description" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="description" value="{{$user_checkin_data->description??''}}" required/>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="phone_number">&nbsp Phone Number</label>
                                    <x-input id="phone_number" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="phone_number" value="{{$user_data->phone_number??''}}" required/>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-modal>
