

<li class="">
    <a class="full" href="{!! url('dashboard') !!}">
        <div class="fa-img-home">
             <span class="title-menu">Dashboard</span>
        </div>
       
    </a>
</li>

@if($_COOKIE['access'] =='admin' )

<li class="treeview">
  <a class="full" href="#">
    <div class="fa-img-ma-data">
        <span class="title-menu">Manajemen Data</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a class="full" href="{!! url('provinsi') !!}">
            <div class="fa-img-province">
                <span class="title-menu-sub">Provinsi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a class="full" href="{!! url('kabupaten') !!}">
            <div class="fa-img-regency">
                <span class="title-menu-sub">Kabupaten</span>
            </div>
        </a>
    </li>
    <li class="">
        <a class="full" href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kriteria Kendala</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('forum') !!}">
            <div class="fa-img-forum">
                <span class="title-menu-sub">Grup Forum</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('status') !!}">
            <div class="fa-img-status">
                <span class="title-menu-sub">Status</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('periode') !!}">
            <div class="fa-img-status">
                <span class="title-menu-sub">Batas Periode</span>
            </div>
        </a>
    </li>


  </ul>
</li>





<li class="treeview">
  <a class="full" href="#">
    <div class="fa-img-ma-user">
        <span class="title-menu">Manajemen User</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">

	<li class="">
        <a class="full" href="{!! url('user') !!}">
            <div class="fa-img-user">
                <span class="title-menu-sub">User</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('role') !!}">
            <div class="fa-img-role">
                <span class="title-menu-sub">Role</span>
            </div>
        </a>
    </li>

  </ul>
</li>


<li class="">
    <a class="full" href="{!! url('pagutarget') !!}">
        <div class="fa-img-pagu">
             <span class="title-menu">Pagu APBN</span>
        </div>
       
    </a>
</li>



<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Monitoring</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a href="{!! url('pagutarget') !!}">
            <div class="fa-img-pagu">
                <span class="title-menu">Pagu APBN</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('promosi') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Promosi</span>
            </div>
        </a>
    </li>

   <li class="">
        <a href="{!! url('imap') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Imap</span>
            </div>
        </a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a class="full" href="#">
    <div class="fa-img-ma-user">
        <span class="title-menu">Tools</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">

    <li class="">
        <a class="full" href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('forum') !!}">
            <div class="fa-img-forum">
                <span class="title-menu-sub">Forum</span>
            </div>
        </a>
    </li>

  </ul>
</li>

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Pelaporan</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a href="{!! url('rekapitulasi') !!}">
            <div class="fa-img-monitoring">
                <span class="title-menu">Rekapitulasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('pagutarget') !!}">
            <div class="fa-img-pagu">
                <span class="title-menu">Pagu APBN</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('promosi') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Promosi</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('imap') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Imap</span>
            </div>
        </a>
    </li>

     <li class="">
        <a  href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

  
  </ul>
</li>


<li class="">
    <a class="full" href="{!! url('auditlog') !!}">
        <div class="fa-img-pagu">
             <span class="title-menu">Audit Log Sistem</span>
        </div>
       
    </a>
</li>


@endif


@if($_COOKIE['access'] =='pusat' )

<li class="">
    <a class="full" href="{!! url('pagutarget') !!}">
        <div class="fa-img-pagu">
             <span class="title-menu">Pagu APBN</span>
        </div>
    </a>
</li>

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Monitoring</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a href="{!! url('pagutarget') !!}">
            <div class="fa-img-pagu">
                <span class="title-menu">Pagu APBN</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('promosi') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Promosi</span>
            </div>
        </a>
    </li>

   <li class="">
        <a href="{!! url('imap') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Imap</span>
            </div>
        </a>
    </li>
  </ul>
</li>



<li class="treeview">
  <a class="full" href="#">
    <div class="fa-img-ma-user">
        <span class="title-menu">Tools</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">

    <li class="">
        <a class="full" href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('forum') !!}">
            <div class="fa-img-forum">
                <span class="title-menu-sub">Forum</span>
            </div>
        </a>
    </li>

  </ul>
</li>

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Pelaporan</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a href="{!! url('rekapitulasi') !!}">
            <div class="fa-img-monitoring">
                <span class="title-menu">Rekapitulasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('pagutarget') !!}">
            <div class="fa-img-pagu">
                <span class="title-menu">Pagu APBN</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('promosi') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Promosi</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('imap') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Imap</span>
            </div>
        </a>
    </li>

     <li class="">
        <a  href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

  
  </ul>
</li>

@endif

@if($_COOKIE['access'] =='province' )

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Updating Data</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('promosi') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Promosi</span>
            </div>
        </a>
    </li>

    
  </ul>
</li>



<li class="treeview">
  <a class="full" href="#">
    <div class="fa-img-ma-user">
        <span class="title-menu">Tools</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">

    <li class="">
        <a class="full" href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('forum') !!}">
            <div class="fa-img-forum">
                <span class="title-menu-sub">Forum</span>
            </div>
        </a>
    </li>

  </ul>
</li>

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Pelaporan</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a href="{!! url('rekapitulasi') !!}">
            <div class="fa-img-monitoring">
                <span class="title-menu">Rekapitulasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('pagutarget') !!}">
            <div class="fa-img-pagu">
                <span class="title-menu">Pagu APBN</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('promosi') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Promosi</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('imap') !!}">
            <div class="fa-img-promosi">
                <span class="title-menu">Imap</span>
            </div>
        </a>
    </li>

     <li class="">
        <a  href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

  
  </ul>
</li>

@endif

@if($_COOKIE['access'] =='daerah' )

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Updating Data</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>

  </ul>
</li>

<li class="treeview">
  <a class="full" href="#">
    <div class="fa-img-ma-user">
        <span class="title-menu">Tools</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">

    <li class="">
        <a class="full" href="{!! url('kendala') !!}">
            <div class="fa-img-kendala">
                <span class="title-menu-sub">Kendala</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('forum') !!}">
            <div class="fa-img-forum">
                <span class="title-menu-sub">Forum</span>
            </div>
        </a>
    </li>

    <li class="">
        <a class="full" href="{!! url('forum') !!}">
            <div class="fa-img-forum">
                <span class="title-menu-sub">Perpanjangan Periode</span>
            </div>
        </a>
    </li>

  </ul>
</li>

<li class="treeview">
  <a class="full" href="#">
     <div class="fa-img-monitoring">
        <span class="title-menu">Pelaporan</span>
    </div>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="pull-left treeview-menu">
    <li class="">
        <a href="{!! url('rekapitulasi') !!}">
            <div class="fa-img-monitoring">
                <span class="title-menu">Rekapitulasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('pagutarget') !!}">
            <div class="fa-img-pagu">
                <span class="title-menu">Pagu APBN</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('perencanaan') !!}">
            <div class="fa-img-perencanaan">
                <span class="title-menu">Perencanaan</span>
            </div>
        </a>
    </li>

    <li class="">
        <a href="{!! url('pengawasan') !!}">
            <div class="fa-img-pengawasan">
                <span class="title-menu">Pengawasan</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('bimsos') !!}">
            <div class="fa-img-bimsos">
                <span class="title-menu">Bimbingan/Sosialisasi</span>
            </div>
        </a>
    </li>
    <li class="">
        <a href="{!! url('penyelesaian') !!}">
            <div class="fa-img-penyelesaian">
                <span class="title-menu">Penyelesaian Masalah</span>
            </div>
        </a>
    </li>
  </ul>
</li>

@endif