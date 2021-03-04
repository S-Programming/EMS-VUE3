<x-modal :id="$id??'common_popup_modal'" :class="$class??''" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Update Project Status</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('project.manager.confirm.working.project.status') }}" id="project-status-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
                                <div class="form-group">
                                    <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden"
                                             name="id" value="{{$project_id??0}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Project Completion Status</label>
                                    <select class="form-control" name="project_completion_status" id="project-status">
                                        <option>10%</option>
                                        <option>20%</option>
                                        <option>30%</option>
                                        <option>40%</option>
                                        <option>50%</option>
                                        <option>60%</option>
                                        <option>70%</option>
                                        <option>80%</option>
                                        <option>90%</option>
                                        <option>100%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>

{{--        <div class="block-content block-content-full text-right border-top">--}}
{{--            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>--}}
{{--            <button type="button" class="checkin-btn btn btn-primary"  onclick="ajaxCallOnclick('confirm/working/project/Status',{project_manager_id:{{$project_manager_id??''}},containerId:'{{"$id"??'common_popup_modal'}}'})"--}}
{{--            >Update</button>--}}

{{--        </div>--}}
    </x-slot>

</x-modal>
<script>

</script>
