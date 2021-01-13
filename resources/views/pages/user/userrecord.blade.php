<x-backend-layout>
<table class="table">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Check In Time</th>
        <th>Check Out Time</th>
        <th>Day</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
        @if(isset($userData) && !empty($userData))
        @foreach($userData as $userData)
                <tr>
                    <td>{{$userData->user_id ?? ""}}</td>
                    <td>{{$userData->checkin ?? ""}}</td>
                    <td>{{$userData->checkout ?? ""}}</td>
                    <td>{{$userData->created_at->format('d M') ?? ""}}</td>
                    <td>{!!$userData->description?? "" !!}</td>
                </tr>
            @endforeach
      @endif
      @if(!isset($userData) && empty($userData))
            <tr>
                <td>No Record Found</td>
            </tr>
       @endif
    </tbody>
</table>
</x-backend-layout>
