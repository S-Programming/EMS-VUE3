<select class="form-control form-control-alt form-control-lg" name="roles">
    @if(isset($roles) &&!empty($roles))
    	<option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{$role->id??0}}">{{$role->name??''}}</option>
        @endforeach
    @endif
</select>
