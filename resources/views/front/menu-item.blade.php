<li class="dropdown menu-item">
    <span>{{ $letter }}</span>
    <div class="dropdown-content">
        @foreach($users as $user)
            <a href="{{ url('/victim/' . $user->id )}}">{{ $user->name }}</a>
        @endforeach

    </div>

</li>