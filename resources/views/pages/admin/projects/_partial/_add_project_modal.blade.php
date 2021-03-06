<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Add Project</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('project.confirm.add.project') }}" id="user-project-manager-id" data-modal-id="{{$id??'common_popup_modal'}}"  enctype="multipart/form-data">
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
                                    <label for="project_name">&nbsp Project Name</label>
                                    <x-input id="project_name" class="form-control form-control-alt form-control-lg" type="text" name="project_name"  autofocus />
                                </div>
                                <div class="form-group">
                                    <label class="d-block" for="project_document">Project Document</label>
                                    <input class="form-control form-control-alt form-control-lg" type="file" id="project_document" name="project_document">
                                </div>
                                <div class="form-group">
                                    <label>Project Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg" name="project_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="roles">&nbsp Project Manager</label>
                                    {!!$project_managers_dropdown??''!!}
                                </div>
                                <div class="form-group">
                                    <label for="technologystack">&nbsp Technology Stack</label>
                                    {!!$technology_stack_dropdown??''!!}
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Date</label>--}}
{{--                                    <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id="date" name="date" placeholder="Select Date" data-min-date="today" readonly="readonly">--}}
{{--                                </div>--}}
                            </div>

                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">
                            {{ __('Add') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-modal>
<script type="text/javascript">
    flatpickr(".js-flatpickr", {
        dateFormat: "d-m-Y"
    });
</script>
