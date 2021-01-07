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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    tinymce.init({
    selector: '.tinymce-editor-cls',
    height: 300,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools'
    ],
    toolbar1: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons',
    image_advtab: true
});
    
</script>