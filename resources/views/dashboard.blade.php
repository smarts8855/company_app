
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi.. <b> {{ Auth::user()->name }} </b>
            <b class="float-right">Total Users
                <span class="badge badge-success">{{ count($users) }}</span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
        <div class="row"></div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">SL No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created At</th>               
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($users as $user)
                <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>                
                <td>
                @if($user->created_at == NULL )
                <span class="text-danger">No Date Set</span>
                @else                    
                {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
              </td>
                @endif              
                
                </tr>
                @endforeach
                
            
            </tbody>
        </table>
        </div>
        </div>
    </div>
</x-app-layout>
