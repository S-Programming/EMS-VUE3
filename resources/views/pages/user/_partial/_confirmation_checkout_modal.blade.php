<x-modal :id="$id??'common_popup_modal'" :class="$class??''" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Report Submit Confirmation</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="block-content font-size-sm">
            <p>Are you sure, want to checkout your log time are remaining?</p>
        </div>
        <div class="block-content block-content-full text-right border-top">        
        <button type="button" class="btn btn-alt-primary mr-1" onclick="updateFormAction('submit-report-span-id')">Confirm</button>
            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel</button>
          

        </div>
    </x-slot>

</x-modal>
