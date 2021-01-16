<x-backend-layout>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title bold">Checkin History</h3>
            <div class="block-options">
                <form method="POST" action="{{ route('checkin.history.user') }}" id="usercheckinhistory-form-id">
                    @csrf
                    <select class="form-control"
                            onchange="ajaxCallOnclick('get_user_checkin',{user_id:this.options[this.selectedIndex].value??'All'})"
                            name="user_id">
                        @if(isset($users) && !empty($users))
                            <option value="All">All</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name}}{{" "}}{{$user->last_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </form>
            </div>
        </div>

        <!-- <div id="one-dashboard-search-orders" class="block-content border-bottom d-none" >
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search"
                               name="one-ecom-orders-search" placeholder="Search krecent orders..">
                        <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                        </div>
                    </div>
                </div>
            </form>

        </div> -->
        <div id="checkin-history" class="block-content">
        {!! $user_history_html??'' !!}
        <!-- Recent Orders Table -->
            <!-- END Pagination -->
        </div>
    </div>

</x-backend-layout>
