<select name="roles">
    @if(isset($roles) &&!empty($roles))
        @foreach($roles as $role)
            <option value="{{$role->id??0}}">{{$role->name??''}}</option>
        @endforeach
    @endif
</select>
