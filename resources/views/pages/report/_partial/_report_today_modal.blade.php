<x-modal :id="$id??'common_popup_modal'" :class="$class??'modal-lg'" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">Summary Details</h3>
    </x-slot>
    <x-slot name="modal_content">
        <div class="block-content font-size-sm">
            <div class="content">
                <!-- Dynamic Table Full Pagination -->
                <div id="task-log-table-section" class="block block-rounded">
                    @include('pages.report._partial._task_log_table_html',['userTaskLogs' => $userTaskLogs ?? ''])
                </div>
                <!-- END Dynamic Table Full Pagination -->
            </div>

            <div class="block-content block-content-full text-right border-top">
                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </x-slot>
</x-modal>