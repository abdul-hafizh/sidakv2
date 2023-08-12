

<li class="">
    <a href="{!! url('dashboard') !!}"><i class="fa fa-home"></i><span>Dashboard</span></a>
</li>

@if($_COOKIE['access'] =='admin' )

<li class="treeview">
  <a href="#">
    <i class="fa fa-bar-chart"></i>
    <span>Manajemen Data</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('dashboard') !!}"><i class="fa fa-circle-o"></i><span>Provinsi</span></a>
    </li>
    <li class="">
        <a href="{!! url('dashboard') !!}"><i class="fa fa-circle-o"></i><span>Kabupaten</span></a>
    </li>
    <li class="">
        <a href="{!! url('dashboard') !!}"><i class="fa fa-circle-o"></i><span>Kriteria Kendala</span></a>
    </li>
    <li class="">
        <a href="{!! url('dashboard') !!}"><i class="fa fa-circle-o"></i><span>Grup Forum</span></a>
    </li>
    <li class="">
        <a href="{!! url('dashboard') !!}"><i class="fa fa-circle-o"></i><span>Status</span></a>
    </li>
    <li class="">
        <a href="{!! url('dashboard') !!}"><i class="fa fa-circle-o"></i><span>Batas Periode</span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-bars"></i>
    <span>Management Data</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">

  <li class="">
      <a href="{!! url('province') !!}"><i class="fa fa-circle-o"></i><span>Provisi</span></a>
  </li>

  <li class="">
      <a href="{!! url('regency') !!}"><i class="fa fa-circle-o"></i><span>Kabupaten</span></a>
  </li>

  <li class="">
      <a href="{!! url('periode') !!}"><i class="fa fa-circle-o"></i><span>Batas Periode</span></a>
  </li>

  </ul>
</li>


<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Manajemen User</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">

	<li class="">
	    <a href="{!! url('user') !!}"><i class="fa fa-circle-o"></i><span>User</span></a>
	</li>

  <li class="">
      <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Role</span></a>
  </li>

  </ul>
</li>

<li class="">
    <a href="{!! url('dashboard') !!}"><i class="fa fa-home"></i><span>Pagu APBN</span></a>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Monitoring</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('user') !!}"><i class="fa fa-circle-o"></i><span>Pagu APBN</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Penyelesaian Masalah</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Promosi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Imap</span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Tools</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Kendala</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Forum</span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Pelaporan</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Rekapitulasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pagu APBN</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Promosi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Imap</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Kendala</span></a>
    </li>
  </ul>
</li>

<li class="">
    <a href="{!! url('dashboard') !!}"><i class="fa fa-home"></i><span>Audit Log Sistem</span></a>
</li>

@endif


@if($_COOKIE['access'] =='pusat' )

<li class="">
    <a href="{!! url('pagutarget') !!}"><i class="fa fa-home"></i><span>Pagu APBN</span></a>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Monitoring</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('pagutarget') !!}"><i class="fa fa-circle-o"></i><span>Pagu APBN</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Penyelesaian Masalah</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Promosi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Imap</span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Tools</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Kendala</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Forum</span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Pelaporan</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Rekapitulasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pagu APBN</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Promosi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Imap</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Kendala</span></a>
    </li>
  </ul>
</li>

@endif

@if($_COOKIE['access'] =='provinsi' )

<li class="treeview">
  <a href="#">
    <i class="fa fa-bars"></i>
    <span>Updating Data</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
          <a href="{!! url('perencanaan') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Penyelesaian Masalah</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Promosi</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Imap</span></a>
      </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Tools</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Kendala</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Forum</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perpanjangan Periode </span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Pelaporan</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Rekapitulasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pagu APBN</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Promosi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Imap</span></a>
    </li>
  </ul>
</li>

@endif

@if($_COOKIE['access'] =='daerah' )

<li class="treeview">
  <a href="#">
    <i class="fa fa-bars"></i>
    <span>Updating Data</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
          <a href="{!! url('perencanaan') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
      </li>
      <li class="">
          <a href="{!! url('pengawasan') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
      </li>
      <li class="">
          <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Penyelesaian Masalah</span></a>
      </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Tools</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Kendala</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Forum</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perpanjangan Periode </span></a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span>Pelaporan</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Rekapitulasi</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pagu APBN</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Pengawasan</span></a>
    </li>
    <li class="">
        <a href="{!! url('role') !!}"><i class="fa fa-circle-o"></i><span>Bimbingan/Sosialisasi</span></a>
    </li>
  </ul>
</li>

@endif