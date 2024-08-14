<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link @if(Request::is('kriteria')) active @endif" href="{{ url('kriteria') }}">Kriteria</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('subkriteria')) active @endif" href="{{ url('subkriteria') }}">Subkriteria</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('dataset')) active @endif" href="{{ url('dataset') }}">Dataset</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('hasil')) active @endif" href="{{ url('hasil') }}">Hasil Analisa</a>
    </li>
</ul>