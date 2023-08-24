
<li>
    <a href="{!! url('dashboard') !!}">
        <i class="fa-icon fa-img-home"></i>
        <span class="title-menu">Dashboard</span>
    </a>
</li>


@if($_COOKIE['access'] =='admin' )
    @include('template/sidakv2/layout.menuadmin')
@endif

@if($_COOKIE['access'] =='pusat' )
    @include('template/sidakv2/layout.menupusat')
@endif

@if($_COOKIE['access'] =='province' )
    @include('template/sidakv2/layout.menuprovince')
@endif

@if($_COOKIE['access'] =='daerah' )
    @include('template/sidakv2/layout.menudaerah')
@endif