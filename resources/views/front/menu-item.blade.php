<li class="dropdown menu-item mr-2.5 lg:mr-5 xl:mr-8">
    <span>{{ $letter }}</span>
    <div class="dropdown-content">
        @foreach($users as $user)
            <a href="{{ url('/victim/' . $user->id )}}">{{ $user->last_name_victim }} {{ $user->name_victim }}</a>
        @endforeach

    </div>

</li>