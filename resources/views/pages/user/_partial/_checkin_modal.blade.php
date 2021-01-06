<x-modal :id="$id??'common_popup_modal'" :class="$class??''" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">CheckIn</h3>
    </x-slot>
    <x-slot name="modal_content" >
        <div class="block-content font-size-sm">
            <p>Are you sure?</p>
        </div>
    </x-slot>
    <x-slot name="action_buttons">
        <div class="block-content block-content-full text-right border-top">
            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" onclick="ajaxCallOnclick('confirm_checkin',{containerId:'{{"$id"??'common_popup_modal123'}}'})">Yes, Checkin</button>
        </div>
    </x-slot>
</x-modal>
