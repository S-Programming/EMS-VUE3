<div class="modal fade" id="{{$id??'common_popup_modal'}}" tabindex="-1" role="dialog"
     aria-labelledby="{{$id??'common_popup_modal'}}" aria-hidden="true">
    <div class="modal-dialog {{$class??''}}" id="modal-{{$id??'common_popup_modal'}}" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header {{$extra['cls'??'']}}">
                    {{$modal_header_content??''}}
                    <div class="block-options">
                        <button type="button" class="btn-block-option" id="close_{{$id??'common_popup_modal'}}"
                                onclick="closeModalById({{'"' . ($id??'common_popup_modal') . '"'}})"
                                aria-label="Close" data-toggle="tooltip" data-original-title="Close Window">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
               {{$modal_content??''}}
                {{$action_buttons??''}}
            </div>
        </div>
    </div>
</div>
