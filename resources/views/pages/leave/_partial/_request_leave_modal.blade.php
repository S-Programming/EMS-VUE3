<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Request Leave</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <form method="POST" action="{{ route('leave.confirm.request') }}" id="leave-request-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
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
                                   <!--  <x-input id="id" class="form-control form-control-alt form-control-lg" type="hidden" name="id" value="{{$user_data->id??0}}" />
                                    --> 
                                </div>
                            </div>
                           <div class="py-3">
                                <div class="form-group">
                                    <label for="types">&nbsp Type</label>
                                    {!!$leave_types_dropdown??''!!}
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="form-group">
                                    <label for="types">&nbsp Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg"  name="description"  required autofocus ></textarea>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label>Multiple Days</label>
                                <select class="form-control" name="multiple-days" onchange="showDate()">
                                    <option value="yes" selected>Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="form-group hide-input" id="half-day">
                                <label>Half Day</label>
                                <select class="form-control" name="half_day">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>

                            <div class="form-group" id="range-group">
                                <label for="">Date Range: </label>
                                <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id=""
                                           name="date_range" placeholder="Select Holidays"
                                           data-mode="range"
                                           data-min-date="today">
                            </div>
                            <div class="form-group hide-input" id="date-group">
                                <label for="">Select Date </label>
                                <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id="date" name="date" placeholder="Select Date" readonly="readonly">
                            </div>
                        </div>
                    </div>
                            <div class="py-3">
                                <div class="form-group">
                                    <label for="types">&nbsp Description</label>
                                    <textarea id="myTextareas" class="tinymce-editor-cls tinymce-modal form-control form-control-alt form-control-lg" name="description" required autofocus></textarea>
                                </div>
                            </div>

                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit') }}
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