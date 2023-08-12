

<li class="">
    <a href="{!! url('dashboard') !!}"><i class="fa fa-home"></i><span>Dashboard</span></a>
</li>

@if($_COOKIE['access'] =='admin' )

<li class="treeview">
  <a href="#">
    <i class="fa fa-bar-chart"></i>
    <span>Report</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">

 <li class="">
    <a href="{!! url('perencanaan') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
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
    <span>Management User</span>
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

@endif


@if($_COOKIE['access'] =='daerah' )

<li class="treeview">
  <a href="#">
    <i class="fa fa-bars"></i>
    <span>Master</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">

 <li class="">
    <a href="{!! url('perencanaan') !!}"><i class="fa fa-circle-o"></i><span>Perencanaan</span></a>
 </li>

  </ul>
</li>


@endif