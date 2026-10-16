@extends('admin.layout')
@section('title', 'Messages')

@section('body')
    @include('admin._bar')

    <main class="wrap">
        <h1>Messages</h1>
        <p style="margin:0">Messages customers sent from the contact form on your website.</p>

        <nav class="tabs">
            <a href="{{ route('admin.messages') }}" class="tab {{ $show === 'new' ? 'on' : '' }}">New ({{ $newCount }})</a>
            <a href="{{ route('admin.messages', ['show' => 'all']) }}" class="tab {{ $show === 'all' ? 'on' : '' }}">All ({{ $allCount }})</a>
        </nav>

        @forelse ($messages as $m)
            @php
                $digits = preg_replace('/\D/', '', (string) $m->phone);
                $wa = str_starts_with($digits, '0') ? '92'.substr($digits, 1) : $digits;
            @endphp
            <article class="card {{ $m->read_at ? '' : 'new' }}">
                <div class="top">
                    <span class="name">{{ $m->name }} @unless($m->read_at)<span class="badge">NEW</span>@endunless</span>
                    <span class="date">{{ $m->created_at->timezone('Asia/Karachi')->format('d M Y, h:i A') }}</span>
                </div>

                <dl>
                    <dt>Phone</dt>
                    <dd><a href="tel:{{ $digits }}">{{ $m->phone }}</a></dd>
                    @if ($m->plan)
                        <dt>Package</dt><dd>{{ $m->plan }}</dd>
                    @endif
                    @if (! empty($m->services))
                        <dt>Needs</dt><dd>{{ collect($m->services)->map(fn ($s) => $serviceNames[$s] ?? $s)->join(', ') }}</dd>
                    @endif
                    @if ($m->budget)
                        <dt>Budget</dt><dd>{{ $m->budget }}</dd>
                    @endif
                    @if ($m->email)
                        <dt>Email</dt><dd>{{ $m->email }}</dd>
                    @endif
                </dl>

                @if ($m->message)
                    <p class="msg">{{ $m->message }}</p>
                @endif

                <div class="actions">
                    @if ($wa)
                        <a class="btn btn-wa btn-sm" target="_blank" rel="noopener"
                           href="https://wa.me/{{ $wa }}?text={{ rawurlencode('Assalam o Alaikum '.$m->name.'! This is '.config('agency.name').'. Thank you for your message.') }}">Reply on WhatsApp</a>
                        <a class="btn btn-light btn-sm" href="tel:{{ $digits }}">Call</a>
                    @endif
                    <form method="POST" action="{{ route('admin.done', $m) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">{{ $m->read_at ? 'Mark as new' : 'Mark as done' }}</button>
                    </form>
                    <form method="POST" action="{{ route('admin.delete', $m) }}" onsubmit="return confirm('Delete this message?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="empty">{{ $show === 'new' ? 'No new messages.' : 'No messages yet.' }}</p>
        @endforelse

        <div class="pager">
            <span>@if ($messages->previousPageUrl())<a href="{{ $messages->previousPageUrl() }}">← Newer</a>@endif</span>
            <span>@if ($messages->nextPageUrl())<a href="{{ $messages->nextPageUrl() }}">Older →</a>@endif</span>
        </div>
    </main>
@endsection
