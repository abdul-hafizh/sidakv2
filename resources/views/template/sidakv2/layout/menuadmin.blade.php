
<li  class="treeview " style="height: auto;">
  <a href="#">
    <i class="fa-icon fa-img-ma-user"></i>
        <span class="title-menu" >Manajemen Data</span>
   
        <span class="pull-right-container ">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
  </a>
  <ul  class="treeview-menu" style="display: none;">

    <li>
        <a href="{!! url('provinsi') !!}">
            <i class="po-top-menu fa-icon fa-img-province"></i> Provinsi
        </a>
    </li>

    <li>
        <a href="{!! url('kabupaten') !!}">  
            <i class="po-top-menu fa-icon fa-img-role"></i> Kabupaten
        </a>
    </li>

    <li>
        <a href="{!! url('kriteria-kendala') !!}">
            <i class="po-top-menu fa-icon fa-img-kendala"></i> Kriteria Kendala
        </a>
    </li>

    <li>
        <a href="{!! url('forum') !!}">  
            <i class="po-top-menu fa-icon fa-img-forum"></i> Grup Forum
        </a>
    </li>

    <li>
        <a href="{!! url('status') !!}">
            <i class="po-top-menu fa-icon fa-img-status"></i> Status
        </a>
    </li>

    <li>
        <a href="{!! url('periode') !!}">  
            <i class="po-top-menu fa-icon fa-img-status"></i> Batas Periode
        </a>
    </li>

  </ul>
</li>


<li  class="treeview" style="height: auto;">
  <a href="#">
    <i class="fa-icon fa-img-ma-user"></i>
        <span class="title-menu" >Manajemen User</span>
   
        <span class="pull-right-container ">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
  </a>
  <ul  class="treeview-menu" style="display: none;">

    <li>
        <a href="{!! url('user') !!}">
            <i class="po-top-menu fa-icon fa-img-user"></i> User
        </a>
    </li>

     <li>
        <a href="{!! url('options') !!}">
            <i class="po-top-menu fa-icon fa-img-user"></i> Role
        </a>
    </li>

     <li>
        <a href="{!! url('action') !!}">
            <i class="po-top-menu fa-icon fa-img-user"></i> Aksi
        </a>
    </li>

   <!--  <li>
        <a href="{!! url('role') !!}">  
            <i class="po-top-menu fa-icon fa-img-role"></i>
                Role
        </a>
    </li> -->

  </ul>
</li>

<li>
    <a href="{!! url('pagutarget') !!}">
        <i class="fa-icon fa-img-pagu"></i>
        <span class="title-menu">Pagu APBN</span>
    </a>
</li>

<li class="treeview" style="height: auto;">
  <a  href="#">
     <i class="fa-icon fa-img-monitoring"></i>
        <span class="title-menu">Monitoring</span>

        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
  </a>
  
  <ul class="treeview-menu" style="display: none;">
     <li >
        <a href="{!! url('pagutarget') !!}">
            <i class="po-top-menu fa-icon fa-img-pagu"></i>
               Pagu APBN
        </a>
    </li>
    <li >
        <a href="{!! url('perencanaan') !!}">
            <i class="po-top-menu fa-icon  fa-img-perencanaan"></i>
               Perencanaan
           
        </a>
    </li>

    <li >
        <a href="{!! url('pengawasan') !!}">
            <i class="po-top-menu fa-icon fa-img-pengawasan"></i>
               Pengawasan
           
        </a>
    </li>
    <li >
        <a href="{!! url('bimsos') !!}">
            <i class="po-top-menu fa-icon fa-img-bimsos"></i>
               Bimbingan/Sosialisasi
            
        </a>
    </li>
    <li >
        <a href="{!! url('penyelesaian') !!}">
            <i class="po-top-menu fa-icon fa-img-penyelesaian"></i>
               Penyelesaian Masalah
            
        </a>
    </li>
    <li >
        <a href="{!! url('promosi') !!}">
            <i class="po-top-menu fa-icon fa-img-promosi"></i>
                Promosi
           
        </a>
    </li>

   <li >
        <a href="{!! url('imap') !!}">
            <i class="po-top-menu fa-icon fa-img-promosi"></i>
              Imap
           
        </a>
    </li>
  </ul>
</li>


<li class="treeview" style="height: auto;">
  <a  href="#">
    <i class="fa-icon fa-img-ma-user"></i>
        <span class="title-menu">Tools</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
  </a>

  <ul class="treeview-menu" style="display: none;">

    <li >
        <a  href="{!! url('kendala') !!}">
            <i class="po-top-menu fa-icon fa-img-kendala"></i>
                Kendala
        </a>
    </li>

    <li >
        <a href="{!! url('forum') !!}">
            <i class="po-top-menu fa-icon fa-img-forum"></i>
              Forum
        </a>
    </li>

  </ul>
</li>


<li class="treeview" style="height: auto;">
  <a href="#">
     <i class="fa-icon fa-img-monitoring"></i>
        <span class="title-menu">Pelaporan</span>

    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="display: none;">
    <li >
        <a href="{!! url('rekapitulasi') !!}">
            <i class="po-top-menu fa-icon fa-img-monitoring"></i>
                Rekapitulasi
        </a>
    </li>
    <li >
        <a href="{!! url('pagutarget') !!}">
            <i class="po-top-menu fa-icon fa-img-pagu"></i>
               Pagu APBN
        </a>
    </li>
    <li>
        <a href="{!! url('perencanaan') !!}">
            <i class="po-top-menu fa-icon fa-img-perencanaan"></i>
              Perencanaan
            
        </a>
    </li>

    <li>
        <a href="{!! url('pengawasan') !!}">
            <i class="po-top-menu fa-icon fa-img-pengawasan"></i>
            Pengawasan
         
        </a>
    </li>
    <li >
        <a href="{!! url('bimsos') !!}">
            <i class="po-top-menu fa-icon fa-img-bimsos"></i>
             Bimbingan/Sosialisasi
        </a>
    </li>
    <li >
        <a href="{!! url('penyelesaian') !!}">
            <i class="po-top-menu fa-icon fa-img-penyelesaian"></i>
            Penyelesaian Masalah
        </a>
    </li>
    <li >
        <a href="{!! url('promosi') !!}">
            <i class="po-top-menu fa-icon fa-img-promosi"></i>
                Promosi
        </a>
    </li>

    <li >
        <a href="{!! url('imap') !!}">
            <i class="po-top-menu fa-icon fa-img-promosi"></i>
                Imap
        </a>
    </li>

     <li >
        <a  href="{!! url('kendala') !!}">
            <i class="po-top-menu fa-icon fa-img-kendala"></i> Kendala
        </a>
    </li>

  
  </ul>
</li>


<li >
    <a  href="{!! url('auditlog') !!}">
        <i class="fa-icon fa-img-pagu"></i>
             <span class="title-menu">Audit Log Sistem</span>
    </a>
</li>
