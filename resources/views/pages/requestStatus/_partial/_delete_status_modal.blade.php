<x-modal :id="$id??'common_popup_modal'" :class="$class??''" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Delete Confirmation</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="block-content font-size-sm">
            <p>Are you sure, want to delete?</p>
        </div>
        <div class="block-content block-content-full text-right border-top">
            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>
            <button type="button" class="checkin-btn btn btn-primary"  onclick="ajaxCallOnclick('status_confirm_delete',{request_status_id:{{$request_status_id}},containerId:'{{"$id"??'common_popup_modal'}}'})" 
                    >Yes,
                    Confirm
            </button>
           
        </div>
    </x-slot>

</x-modal>
