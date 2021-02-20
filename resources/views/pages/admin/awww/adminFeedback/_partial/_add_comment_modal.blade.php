<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Comment Modal</h3>
    </x-slot>
    <x-slot name="modal_content">
        <form action="{{ route("comment.add.confirm") }}" method="POST" id="add-comment-modal" data-modal-id="{{$id??'common_popup_modal'}}">
            @csrf
            @php
                $inyMceConfig = theme_tinyMCE_default_config();
                $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                $inyMceConfig['selector'] = '.tinymce-editor-cls';
            echo theme_tinyMCE_script($inyMceConfig);
            @endphp
            <input type="hidden" name="feedback_id" value="{{$feedback_id}}">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Type Your Comment</label>
                                {{--<textarea id="js-ckeditor" class="textarea_value" name="product_description"></textarea>--}}
                                <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="admin_comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Info -->


            <div class="block block-rounded">

{{--                <div class="block-content">--}}
{{--                    <div class="row">--}}
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>
                            <button type="button" class="checkin-btn btn btn-primary" onclick="validateFieldsByFormId(this)"
                            >Yes,
                                Confirm
                            </button>
                        </div>
        </form>
    </x-slot>

</x-modal>
