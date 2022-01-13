@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
      Users
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->is_admin == true)
                        <span class="badge bg-primary">Admin</span>
                    @else
                        <span class="badge bg-warning text-dark">User</span>
                    @endif
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>


@endsection
@section('css')
    
@endsection

@section('js')
   
@endsection
