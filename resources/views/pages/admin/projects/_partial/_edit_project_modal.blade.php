<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Update Project</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('user.confirm.edit.project') }}" id="project-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
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
                                <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden"
                                         name="id" value="{{$project->id??0}}"/>
                                <div class="form-group">
                                    <label for="project_name">&nbsp Project Name</label>
                                    <x-input id="project_name" class="form-control form-control-alt form-control-lg"
                                             type="text"
                                             name="project_name" value="{{$project->name??''}}" required
                                             autofocus/>
                                </div>
                                <div class="form-group">
                                    <label>Project Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="project_description">{!!$project->description??''!!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="roles">&nbsp Role</label>
                                    {!!$roles_dropdown??''!!}
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
{{--                                    <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id="date" name="date" placeholder="Select Date" data-min-date="today" value="{{$project->start_date??''}}" readonly="readonly">--}}
                                    <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id="date" name="date" placeholder="Select Date" data-min-date="today" value="{{date('d m Y', strtotime($project->start_date))??''}}" readonly="readonly">
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
                            {{ __('Update') }}
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
