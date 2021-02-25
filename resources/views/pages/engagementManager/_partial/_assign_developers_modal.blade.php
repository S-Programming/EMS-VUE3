<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Assign Developers</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('assign.confirm.project.developers') }}" id="assign-developer-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="py-2">
                                <div class="form-group">
                                    <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden"
                                             name="id" value="{{$project_id??0}}"/>
{{--                                    <label for="first_name">&nbsp First Name</label>--}}
{{--                                    <x-input id="first_name" class="form-control form-control-alt form-control-lg"--}}
{{--                                             type="text"--}}
{{--                                             name="first_name" value="{{$user_data->first_name??''}}" required--}}
{{--                                             autofocus/>--}}
                                </div>
                                <div class="form-group">
                                    <label for="roles">&nbsp Developers</label>
                                    {!!$developers_dropdown??''!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)">
                            {{ __('Assign') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-modal>
