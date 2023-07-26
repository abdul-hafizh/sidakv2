@extends('template/apex.app')

@section('content')
    <div id="app" >
        
		    <transition name="fade">
		       <router-view></router-view>
		    </transition>
	    
    </div>  
@stop
  

