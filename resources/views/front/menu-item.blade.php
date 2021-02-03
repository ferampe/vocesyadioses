<li class="dropdown menu-item">
    <span>{{ $letter }}</span>
    <div class="dropdown-content">
        @foreach($users as $user)
            <a href="{{ url('/victim/' . $user->id )}}">{{ $user->last_name_victim }} {{ $user->name_victim }}</a>
        @endforeach

    </div>

</li>