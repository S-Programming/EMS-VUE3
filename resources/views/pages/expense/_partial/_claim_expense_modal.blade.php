<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Claim Expense</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('expense.confirm.claim') }}" id="expense-claim-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                
                    @php
                        $inyMceConfig = theme_tinyMCE_default_config();
                        $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                        $inyMceConfig['selector'] = '.tinymce-editor-cls';
                    echo theme_tinyMCE_script($inyMceConfig);
                    @endphp
                    <div class="card">
                        <div class="card-body">
                           <div class="py-3">
                                <div class="form-group">
                                    <label for="reason">&nbsp Reason</label>
                                     <x-input id="reason" class="form-control form-control-alt form-control-lg" type="text" name="reason" />
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="form-group">
                                    <label for="types">&nbsp Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="description"  required  ></textarea>
                                </div>
                            </div> 
                           <div class="py-3">
                                <div class="form-group">
                                    <label for="amount">&nbsp Amount</label>
                                     <x-input id="amount" class="form-control form-control-alt form-control-lg" type="text" name="amount" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-modal>
<script type="text/javascript">
    flatpickr(".js-flatpickr", {
        dateFormat:"d-m-Y"
    });
</script>