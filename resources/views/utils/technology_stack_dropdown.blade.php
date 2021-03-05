@foreach($technologies as $technology)
    @dd($technologies,$technology['id'])
    @endforeach
<select class="form-control form-control-alt form-control-lg" name="technology_stack_id[]" multiple>
    @if(isset($technologies) &&!empty($technologies))
        @foreach($technologies as $technology)
{{--            @dd($technologies)--}}

                        <option value="{{$technology->id??0}}" {!! isset($projectTechnologies)&& in_array($technology->id,$projectTechnologies)?'selected="selected"':''!!}">{{$technology->name??''}}</option>
{{--            <option value="{{$technology->id??0}}">{{$technology->name??''}}</option>--}}
        @endforeach
    @endif
</select>
