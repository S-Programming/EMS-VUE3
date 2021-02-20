<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Quries</h3>
    </x-slot>
    <x-slot name="modal_content">
        <form action="{{ route("userquery.add.confirm") }}" method="POST" id="add-feedback-form" data-modal-id="{{$id??'common_popup_modal'}}">
            @csrf
            @php
                $inyMceConfig = theme_tinyMCE_default_config();
                $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                $inyMceConfig['selector'] = '.tinymce-editor-cls';
            echo theme_tinyMCE_script($inyMceConfig);
            @endphp

            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
{{--                            <div class="form-group">--}}
{{--                                <label for="first_name">First Name</label>--}}
{{--                                <input type="text" class="form-control" id="first_name" name="first_name">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="last_name">Last Name</label>--}}
{{--                                <input type="text" class="form-control" id="last_name" name="last_name">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="Topic">Topic</label>
                                <input type="text" class="form-control" id="topic" name="topic">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="email">Email</label>--}}
{{--                                <input type="email" class="form-control" id="email" name="email" value="{{$user_email??''}}" readonly/>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label>Description</label>
                                {{--<textarea id="js-ckeditor" class="textarea_value" name="product_description"></textarea>--}}
                                <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="feedback_description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Info -->

            <!-- Stock and Meta Data -->
            <div class="block block-rounded">

                <div class="block-content">
                    <div class="row">
{{--                        <div class="col-sm-12 col-md-6 col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="d-block">Experience</label>--}}
{{--                                <div class="custom-control custom-radio custom-control-inline mb-1">--}}
{{--                                    <input type="radio" class="custom-control-input" id="feedback_status_bad" name="feedback_status" value="bad" checked>--}}
{{--                                    <label class="custom-control-label" for="feedback_status_bad">Bad</label>--}}
{{--                                </div>--}}
{{--                                <div class="custom-control custom-radio custom-control-inline mb-1">--}}
{{--                                    <input type="radio" class="custom-control-input" id="feedback_status_average" name="feedback_status" value="average">--}}
{{--                                    <label class="custom-control-label" for="feedback_status_average">Average</label>--}}
{{--                                </div>--}}
{{--                                <div class="custom-control custom-radio custom-control-inline mb-1">--}}
{{--                                    <input type="radio" class="custom-control-input" id="feedback_status_good" name="feedback_status" value="good">--}}
{{--                                    <label class="custom-control-label" for="feedback_status_good">Good</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
