<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
  </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">


                <table class="table-auto">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if($employees)
                    @foreach($employees as $employee)
                    <tr class="bg-gray-200">
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->department_name }}</td>
                        <td>{{ $employee->position_name }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            <a href="{{ route('edit', [$employee->id]) }}">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('delete', [$employee->id]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No records</p>
            @endif
        </div>
        @if(session('message'))
        <p>{{ session('message') }}</p>
        @endif
        <a href="{{ route('add') }}">Add employee</a>
    </div>
</div>
</div>
</x-app-layout>