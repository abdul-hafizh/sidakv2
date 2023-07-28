@extends('template/adminlte.app')

@section('content')
    <div id="app" class="wrapper">
	    <transition name="fade">
	       <router-view></router-view>
	    </transition>
	</div> 
@stop
  

