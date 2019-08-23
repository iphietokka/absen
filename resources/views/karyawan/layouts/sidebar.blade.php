<nav id="sidebar">
            <div class="sidebar-header bg-lightblue">
                <div class="logo">
                <a href="/" class="simple-text">
                    <img src="{{ asset('/assets/images/img/logo-small.png') }}">
                </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li class="">
                    <a href="{{ url('karyawan') }}">
                        <i class="ui icon sliders horizontal"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('karyawan/absensi') }}">
                        <i class="ui icon clock outline"></i>
                        <p>Absensi</p>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('karyawan/jadwal') }}">
                        <i class="ui icon calendar alternate outline"></i>
                        <p>Jadwal Kerja</p>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('karyawan/cuti') }}">
                        <i class="ui icon calendar plus outline"></i>
                        <p>Data Cuti</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('karyawan/settings') }}">
                        <i class="ui icon cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>