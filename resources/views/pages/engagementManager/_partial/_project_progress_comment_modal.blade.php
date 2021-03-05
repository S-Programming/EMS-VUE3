<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Comment</h3>
    </x-slot>
    <x-slot name="modal_content">
        <form action="{{ route("engagement.manager.confirm.comment.progress") }}" method="POST" id="add-comment-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
            @csrf
            @php
                $inyMceConfig = theme_tinyMCE_default_config();
                $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                $inyMceConfig['selector'] = '.tinymce-editor-cls';
            echo theme_tinyMCE_script($inyMceConfig);
            @endphp
            <input type="hidden" name="project_id" value="{{$project_id??''}}">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Type Your Comment</label>
                                <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="project_progress_comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Info -->
            <div class="block block-rounded">
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>
                    <button type="button" class="checkin-btn btn btn-primary" onclick="validateFieldsByFormId(this)"
                    >Comment</button>
                </div>
        </form>
    </x-slot>

</x-modal>
