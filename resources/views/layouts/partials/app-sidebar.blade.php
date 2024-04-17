<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">

        <li class="menu-title" key="t-menu">Menu</li>

        <li>
            <a href="{{ route('dashboard') }}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-dashboard">Dashboard</span>
            </a>
        </li>

        <li class="menu-title" key="t-master-data">Master Data</li>

        <li>
            <a href="{{ route('employee') }}" class="waves-effect">
                <i class='bx bx-group'></i>
                <span key="t-karyawan">Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('regional') }}" class="waves-effect">
                <i class='bx bx-map-alt'></i>
                <span key="t-regional">Regional</span>
            </a>
        </li>

        <li>
            <a href="{{ route('company') }}" class="waves-effect">
                <i class='bx bxs-business'></i>
                <span key="t-company">Perusahaan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('division') }}" class="waves-effect">
                <i class='bx bx-sitemap'></i>
                <span key="t-division">Divisi</span>
            </a>
        </li>

        <li class="menu-title" key="t-asset">Asset</li>

        <li>
            <a href="{{ route('category') }}" class="waves-effect">
                <i class='bx bxs-purchase-tag-alt'></i>
                <span key="t-category">Kategori</span>
            </a>
        </li>

        <li>
            <a href="{{ route('supplier') }}" class="waves-effect">
                <i class='bx bx-paper-plane'></i>
                <span key="t-supplier">Supplier</span>
            </a>
        </li>

        <li>
            <a href="{{ route('asset') }}" class="waves-effect">
                <i class='bx bxs-briefcase'></i>
                <span key="t-karyawan">Asset</span>
            </a>
        </li>

        <li class="menu-title" key="t-apps">Transaksi</li>

        <li>
            <a href="{{ route('transaction.create') }}" class="waves-effect">
                <i class='bx bx-transfer-alt'></i>
                <span key="t-transaction">Tambah Transaksi</span>
            </a>
        </li>

        <li>
            <a href="{{ route('transaction') }}" class="waves-effect">
                <i class='bx bx-list-ul'></i>
                <span key="t-transaction">Daftar Transaksi</span>
            </a>
        </li>

        <li class="menu-title" key="t-apps">Monitoring</li>

        <li>
            <a href="{{ route('monitor.asset') }}" class="waves-effect">
                <i class='bx bx-list-ul'></i>
                <span key="t-transaction">Per Asset</span>
            </a>
        </li>

        <li>
            <a href="{{ route('monitor.employee') }}" class="waves-effect">
                <i class='bx bx-list-ul'></i>
                <span key="t-transaction">Per Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('monitor.company') }}" class="waves-effect">
                <i class='bx bx-list-ul'></i>
                <span key="t-transaction">Per Perusahaan</span>
            </a>
        </li>
    </ul>
</div>
