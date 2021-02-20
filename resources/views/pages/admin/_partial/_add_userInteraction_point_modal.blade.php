<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Your Discussion Point</h3>
    </x-slot>
    <x-slot name="modal_content">
        <form action="{{ route("user.confirm.add.discussionPoint") }}" method="POST" id="add-discussion-point-modal" data-modal-id="{{$id??'common_popup_modal'}}">
            @csrf
            @php
                $inyMceConfig = theme_tinyMCE_default_config();
                $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                $inyMceConfig['selector'] = '.tinymce-editor-cls';
            echo theme_tinyMCE_script($inyMceConfig);
            @endphp
            <input type="hidden" name="user_id" value="{{$user_id??''}}">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Type Your Discussion Point</label>
                                {{--<textarea id="js-ckeditor" class="textarea_value" name="product_description"></textarea>--}}
                                <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="discussion_point"></textarea>
                            </div>
                            <input type="date" id="date" name="date">
{{--                            <div class="form-group hide-input" id="date-group">--}}
{{--                                <label for="">Select Date </label>--}}
{{--                                <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id="date" name="date" placeholder="Select Date" data-min-date="today" readonly="readonly">--}}
{{--                            </div>--}}
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
<script type="text/javascript">
    flatpickr(".js-flatpickr", {
        dateFormat:"d-m-Y"
    });
</script>
