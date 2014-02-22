@extends('layouts.master')

@section('content')

<h1>All Users</h1>

	@if ($users !== null)
		
        <table class="table table-hover">
            <th>
                <tr>
                    <td>User id </td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td> Email</td>
                    <td>Groups</td>
                    <td>Activated</td>
                    <td>Actions</td>
                </tr>
                            </th>

                @foreach ($users as $user)
                <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->groupName }}</td>
                    <td>{{ $user->activated }}</td>
                    <td>{{ HTML::link('users/' . $user->id . '/edit', 'edit'), " ",
                        HTML::link('users/' . $user->id . '/delete', 'delete'), " ",
                        HTML::link('users/' . $user->id , 'show')
                        
                        }}</td>
                </tr>
                </tbody>
                @endforeach    
            
        </table>
		
                    
   			
		   
	@endif
 

@stop





