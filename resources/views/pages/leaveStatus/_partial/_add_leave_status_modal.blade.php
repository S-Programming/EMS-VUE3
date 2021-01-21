<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-sm'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Leave Status</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('leave.status.confirm.add') }}" id="leave-status-add-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
                                <div class="form-group">
                                    <!-- <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden" name="id"/> -->
                                    <label for="status">&nbsp Status</label>
                                    <x-input id="status" class="form-control form-control-alt form-control-lg" type="text" name="status" required autofocus />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-modal>