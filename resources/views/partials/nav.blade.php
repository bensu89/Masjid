<nav class="nav">
    <a href="{{ route('transactions.index') }}">Dashboard Warga</a>
    <a href="{{ route('transactions.admin') }}" class="@if(Request::routeIs('transactions.admin')) active @endif">Keuangan</a>
    <a href="{{ route('petugas_jumat.index') }}" class="@if(Request::routeIs('petugas_jumat.*')) active @endif">Petugas Jumat</a>
    <a href="{{ route('jadwal.index') }}" class="@if(Request::routeIs('jadwal.*')) active @endif">Jadwal Jumat</a>
    <a href="{{ route('acara.index') }}" class="@if(Request::routeIs('acara.*')) active @endif">Acara Keagamaan</a>
    <a href="{{ route('logout') }}" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</nav>
