<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">CheckOut</h3>
    </x-slot>
    <x-slot name="modal_content" >
        <div class="block-content font-size-sm">
            <h3>Are you sure?</h3>
            <form method="POST" action="{{ route('confirm.checkout') }}" id="checkout-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
                @csrf
                
                @php
                    $inyMceConfig = theme_tinyMCE_default_config();
                    $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                    $inyMceConfig['selector'] = '.tinymce-editor-cls';
                echo theme_tinyMCE_script($inyMceConfig);
                @endphp
                <div class="py-3">
                    <p class="font-size-h3">What I have done today?</p>
                    <div class="form-group">
                        <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="done_today"  required autofocus ></textarea>
                    </div>
                </div>

                <div class="py-3">
                    <p class="font-size-h3">What I'll do tomorrow?</p>
                    <div class="form-group">
                        <textarea class="form-control form-control-lg"  name="do_tomorrow"  required autofocus ></textarea>
                    </div>
                </div>

                <div class="py-3">
                    <p class="font-size-h3">Any Questions / Roadblocks?</p>
                    <div class="form-group">
                        <textarea class="form-control form-control-lg"  name="questions"  required autofocus ></textarea>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>
                    <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id"
                                id="validation-span-id" >
                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Check Out') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-slot>
</x-modal>
