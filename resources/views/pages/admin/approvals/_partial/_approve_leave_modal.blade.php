<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Approve Leave</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('leave.confirm.approve.leave') }}" id="approve-leave-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="py-3">
                                <div class="form-group">
                                    <label for="roles">&nbsp Status</label>
                                    {!!$status_dropdown??''!!}
                                </div>
                            </div>
                            <div class="py-2">
                                <div class="form-group">
                                    <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden"
                                             name="id" value="{{$requestedLeaveId??0}}"/>
                                             @php
                                                $inyMceConfig = theme_tinyMCE_default_config();
                                                $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                                                $inyMceConfig['selector'] = '.tinymce-editor-cls';
                                            echo theme_tinyMCE_script($inyMceConfig);
                                            @endphp
                                <div class="py-3">
                                    <div class="form-group">
                                        <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="comments"  required  ></textarea>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)"
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
