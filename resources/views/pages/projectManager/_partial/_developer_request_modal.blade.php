<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Request For Developers</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form action="{{route('project.manager.confirm.developers.request')}}" method="POST" id="developer-request-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    @php
                        $inyMceConfig = theme_tinyMCE_default_config();
                        $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';
                        $inyMceConfig['selector'] = '.tinymce-editor-cls';
                        echo theme_tinyMCE_script($inyMceConfig);
                    @endphp
                    <input type="hidden" name="project_id" value="{{$project_id??''}}">

                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
{{--                                <div class="form-group">--}}
{{--                                    <label for="role">&nbsp Technology Stack</label>--}}
{{--                                    {!!$technology_stack_dropdown!!}--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="role">&nbsp Number of Developers</label>
                                    <x-input id="role" class="form-control form-control-alt form-control-lg"
                                             type="number" min="0" max="20"
                                             name="no_of_developers" required
                                             autofocus/>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Type Your Comment</label>--}}
{{--                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="pm_comment"></textarea>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Project Description</label>--}}
{{--                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg" name="pm_description"></textarea>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label>Project Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg" name="project_manager_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id="date" name="start_date" placeholder="Select Date" data-min-date="today" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Estimate Time</label>
                                    <input type="text" name="estimate_time" class="form-control" placeholder="Estimate Time">                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
{{--                        <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)"--}}
{{--                                  data-validation="validation-span-id"--}}
{{--                                  id="validation-span-id">{{ __('Request') }}--}}
{{--                        </x-button>--}}
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                            {{ __('Request') }}
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
