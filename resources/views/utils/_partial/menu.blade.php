<li class="nav-main-item">
    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="{{route($data['route']??'')}}">
        <i class="nav-main-link-icon si si-cursor"></i>
        <span class="nav-main-link-name">{{$data['name']??''}}</span>
    </a>
</li>
