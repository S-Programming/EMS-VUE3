<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Leave</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('leave.confirm.add') }}" id="leave-add-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    @php
                    $inyMceConfig = theme_tinyMCE_default_config();
                    $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                    $inyMceConfig['selector'] = '.tinymce-editor-cls';
                    echo theme_tinyMCE_script($inyMceConfig);
                    @endphp
                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
                                <div class="form-group">
                                    <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden" name="id" value="{{$user_data->id??0}}" />
                                    <label for="date">&nbsp Date</label>
                                    <x-input id="date" class="form-control form-control-alt form-control-lg" type="date" name="date" value="{{$user_data->first_name??''}}" required autofocus />
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="form-group">
                                    <label for="types">&nbsp Type</label>
                                    {!!$leave_types_dropdown??''!!}
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="form-group">
                                    <label for="types">&nbsp Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg" name="description" required autofocus></textarea>
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