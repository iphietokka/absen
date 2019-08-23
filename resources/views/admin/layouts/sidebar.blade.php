   <nav id="sidebar">
            <div class="sidebar-header bg-lightblue">
                <div class="logo">
                <a href="/" class="simple-text">
                    <img src="{{ asset('/assets/images/img/Untitled-2.png') }}">
                </a>
                </div>
            </div>

            <ul class="list-unstyled">
                <li class="">
                    <a href="{{ url('admin') }}">
                        <i class="ui icon sliders horizontal"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
              <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">  <i class="ui icon sliders horizontal"></i> <p>Master Data</p></a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                   <li>
                        <a href="{{url('admin/user')}}">User</a>
                    </li>
                    <li>
                        <a href="{{url('admin/karyawan')}}">Karyawan</a>
                    </li>
                    <li>
                        <a href="{{url('admin/jenis-cuti')}}">Jenis Cuti</a>
                    </li>
                     <li>
                        <a href="{{url('admin/departemen')}}">Departemen</a>
                    </li>
                    <li>
                        <a href="{{url('admin/jabatan')}}">Jabatan</a>
                    </li>
                    <li>
                        <a href="{{url('admin/perusahaan')}}">Perusahaan</a>
                    </li>
                   
                </ul>
            </li>
               
                    
                <li class="">
                    <a href="{{ url('admin/absensi') }}">
                        <i class="ui icon clock outline"></i>
                        <p>Absensi</p>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('admin/jadwal') }}">
                        <i class="ui icon calendar alternate outline"></i>
                        <p>Jadwal Kerja</p>
                    </a>
                </li>
                
                <li class="">
                    <a href="{{ url('admin/cuti') }}">
                        <i class="ui icon calendar plus outline"></i>
                        <p>Cuti</p>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('admin/laporan') }}">
                        <i class="ui icon chart bar outline"></i>
                        <p>Laporan</p>
                    </a>
                </li>
             
                <li>
                    <a href="{{ url('admin/settings') }}">
                        <i class="ui icon cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>