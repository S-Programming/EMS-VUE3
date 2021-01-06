<x-modal :id="$id??'common_popup_modal'" :class="$class??''" :extra="['cls'=>'bg-primary-dark']">
    <x-slot name="modal_header_content">
        <h3 class="block-title">My Example Modal</h3>
    </x-slot>
    <x-slot name="modal_content" >
        <div class="block-content font-size-sm">
            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor
                tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum
                quis in sit varius lorem sit metus mi.</p>
            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor
                tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum
                quis in sit varius lorem sit metus mi.</p>
        </div>
    </x-slot>
    <x-slot name="action_buttons">
        <div class="block-content block-content-full text-right border-top">
            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
        </div>
    </x-slot>
</x-modal>
