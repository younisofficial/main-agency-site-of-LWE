<header class="bar">
    <div class="wrap">
        <a href="{{ route('admin.messages') }}"><img src="/images/growmiotech-logo-white.svg" alt="{{ config('agency.name') }}"></a>
        <nav class="nav">
            <a href="{{ route('admin.messages') }}" class="{{ request()->routeIs('admin.messages') ? 'on' : '' }}">Messages</a>
            <a href="{{ route('admin.password') }}" class="{{ request()->routeIs('admin.password') ? 'on' : '' }}">Change password</a>
            <a href="/" target="_blank">View website</a>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm">Log out</button>
            </form>
        </nav>
    </div>
</header>
