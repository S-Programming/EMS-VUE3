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
