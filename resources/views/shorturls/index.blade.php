<h2>Short URLs</h2>

<ul>
@foreach($urls as $url)
    <li>{{ $url->short_code }}  {{ $url->original_url }}</li>
@endforeach
</ul>
