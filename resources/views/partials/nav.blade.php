<nav class="nav">
    <a href="{{ route('transactions.index') }}" @if(Request::routeIs('transactions.index')) class="active" @endif>Dashboard Warga</a>
    <a href="{{ route('transactions.admin') }}" @if(Request::routeIs('transactions.admin')) class="active" @endif>Keuangan</a>
    <a href="{{ route('petugas_jumat.index') }}" @if(Request::routeIs('petugas_jumat.*')) class="active" @endif>Petugas Jumat</a>
    <a href="{{ route('jadwal.index') }}" @if(Request::routeIs('jadwal.*')) class="active" @endif>Jadwal Jumat</a>
    <a href="{{ route('pengajian.index') }}" @if(Request::routeIs('pengajian.*')) class="active" @endif>Jadwal Pengajian</a>
    <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</nav>
