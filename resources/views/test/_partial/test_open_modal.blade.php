<x-modal :id="$id" >
    <x-slot name="modal_content">
    <div class="card">
        <div class="row">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row zrow">

                    <div class="form Exhibitions">

                        <div class="max-exhibitions">
                            <form method="POST" action="{{ route('login') }}"
                                  id="update-exhibition-form-id">
                                @csrf
                                <input type="hidden" class="form-control rounded-0"
                                       name="id" value="{{$data['id']??''}}">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Exhibitions
                                        Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-0"
                                               name="title" value="{{$data['title']??''}}">
                                    </div>
                                </div>
                                <!---form-group--->

                                <div class="form-group row">
                                    <label for="description"
                                           class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-0"
                                               name="description" value="{{$data['description']??''}}">
                                    </div>
                                </div>
                                <!---form-group--->

                                <div class="form-group row">
                                    <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-0"
                                               name="logo" value="{{$data['logo']??''}}">
                                    </div>
                                </div>
                                <!---form-group--->

                                <div class="form-group row">
                                    <label for="start_date" class="col-sm-3 col-form-label">Start
                                        Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-0"
                                               name="start_date" value="{{$data['start_date']??''}}">
                                    </div>
                                </div>
                                <!---form-group--->

                                <div class="form-group row">
                                    <label for="end_date" class="col-sm-3 col-form-label">End
                                        Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-0"
                                               name="end_date" value="{{$data['end_date']??''}}">
                                    </div>
                                </div>
                                <!---form-group--->

                                <div class="form-group row">
                                    <label for="visitors" class="col-sm-3 col-form-label">Planned Visitors</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control rounded-0" min="0"
                                               name="visitors" value="{{$data['planned_visitors']??''}}">
                                    </div>
                                </div>


                                <!---form-group--->
                                <div class="col-auto ">
                                    <button type="submit" onclick="validateFieldsByFormId(this)"
                                            data-validation="validation-span-id2"
                                            class="btn btn-primary mb-2 float-right rounded-0 px-4 btn-save">
                                        Save
                                    </button>

                                </div>
                            </form>
                        </div>
                        <!---max width-->


                    </div>
                    <!----form-->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    </x-slot>
</x-modal>
