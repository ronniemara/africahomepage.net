@extends('layouts.default')

@section('content')
	<h1>Hello</h1>
@if(Auth::check())
<div class="header">
Welcome back, {{ Auth::user()->username }}!<br />
{{ HTML::link('logout', 'Logout') }}
</div>
@endif
@stop
