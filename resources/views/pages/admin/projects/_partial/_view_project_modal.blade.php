<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-xl'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Project Detail</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                <tr>
                    <th>Project Description</th>
                    <th>Project Manager Description</th>
                    <th>Technology Stacks</th>
{{--                    <th>Technology Stack</th>--}}
{{--                    <th>Assign Developers</th>--}}
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="font-w600 font-size-sm">{!!$project->description??''!!}</td>
                            <td class="font-w600 font-size-sm">{!!$project->pm_description??''!!}</td>
                            <td class="font-w600 font-size-sm">
                                @foreach($project->technologystack as $data)
                                    {{$data->name??''}}
                                @endforeach
                            </td>
                            {{--                            <td class="font-w600 font-size-sm">{{$project->users->first_name??''}} {{$project->users->last_name??''}}</td>--}}
{{--                            <td class="text-center font-w600 font-size-sm">{{$project->number_of_developers??''}}</td>--}}


{{--                            <td class="font-w600 font-size-sm">--}}
{{--                                @foreach($project->technologystack as $data)--}}
{{--                                    {{$data->name??''}}--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
                        </tr>
                </tbody>
            </table>
        </div>
    </x-slot>
</x-modal>
<script type="text/javascript">
    flatpickr(".js-flatpickr", {
        dateFormat:"d-m-Y"
    });
</script>



{{--<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">--}}
{{--    <x-slot name="modal_header_content">--}}
{{--        <h3 class="block-title">Update Project</h3>--}}
{{--    </x-slot>--}}
{{--    <x-slot name="modal_content">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-10 offset-1">--}}
{{--                <form id="project-detail-id"--}}
{{--                      data-modal-id="{{$id??'common_popup_modal'}}">--}}
{{--                    @csrf--}}
{{--                    @php--}}
{{--                        $inyMceConfig = theme_tinyMCE_default_config();--}}
{{--                        $inyMceConfig['is_tiny_mce_modal'] = $id??'common_popup_modal';--}}
{{--                        $inyMceConfig['selector'] = '.tinymce-editor-cls';--}}
{{--                    echo theme_tinyMCE_script($inyMceConfig);--}}
{{--                    @endphp--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="py-2">--}}
{{--                                <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden"--}}
{{--                                         name="id" value="{{$project->id??0}}"/>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="project_name">&nbsp Project Name</label>--}}
{{--                                    <x-input id="project_name" class="form-control form-control-alt form-control-lg"--}}
{{--                                             type="text"--}}
{{--                                             name="project_name" value="{{$project->name??''}}" required--}}
{{--                                             autofocus/>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Project Description</label>--}}
{{--                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="project_description">{!!$project->description??''!!}</textarea>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Project Manager Description</label>--}}
{{--                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="project_description">{!!$project->pm_description??''!!}</textarea>--}}
{{--                                </div>--}}
{{--                                <label>Technology Stacks</label><br>--}}
{{--                                <td class="font-w600 font-size-sm">--}}
{{--                                    @foreach($project->technologystack as $data)--}}
{{--                                        {{$data->name??''}}--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="roles">&nbsp Project Managers</label>--}}
{{--                                    {!!$project_managers_dropdown??''!!}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="block-content block-content-full text-right border-top">--}}
{{--                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel--}}
{{--                        </button>--}}
{{--                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)"--}}
{{--                                  data-validation="validation-span-id"--}}
{{--                                  id="validation-span-id">--}}
{{--                            {{ __('Update') }}--}}
{{--                        </x-button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </x-slot>--}}
{{--</x-modal>--}}
{{--<script type="text/javascript">--}}
{{--    flatpickr(".js-flatpickr", {--}}
{{--        dateFormat:"d-m-Y"--}}
{{--    });--}}
{{--</script>--}}
