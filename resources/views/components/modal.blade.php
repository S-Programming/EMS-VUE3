<div class="modal fade" id="{{$id??'common_popup_modal'}}" tabindex="-1" role="dialog"
     aria-labelledby="{{$id??'common_popup_modal'}}" aria-hidden="true">
    <div class="modal-dialog {{$class??''}}" id="modal-{{$id??'common_popup_modal'}}" role="document">


        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Modal Title</h3>
                    <div class="block-options">

                        <button type="button" class="btn-block-option" id="close_{{$id??'common_popup_modal'}}"
                                onclick="closeModalById({{'"' . ($id??'common_popup_modal') . '"'}})"
                                aria-label="Close" data-toggle="tooltip" data-original-title="Close Window">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
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
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
        {{--        <div class="modal-content">--}}
        {{--            <div class="modal-header">--}}
        {{--                @yield('modal_header_content')--}}
        {{--                 {{$modal_header_content??''}}--}}
        {{--                <button type="button" class="close" id="close_{{$id??'common_popup_modal'}}"--}}
        {{--                        onclick="closeModalById({{'"' . ($id??'common_popup_modal') . '"'}})"--}}
        {{--                        aria-label="Close" data-toggle="tooltip" data-original-title="Close Window">--}}
        {{--                    <span aria-hidden="true" class="fa"><b>&times</b><i class="fa fa-times-circle-o"></i></span>--}}
        {{--                </button>--}}
        {{--            </div>--}}
        {{--            <div class="modal-body">--}}
        {{--                @yield('modal_content')--}}
        {{--                {{$modal_content??''}}--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</div>
{{--@yield('modal_js')--}}
{{--@yield('modal_css')--}}
