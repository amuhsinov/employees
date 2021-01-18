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
                <form action="{{ (isset($employee)) ? route('update') : route('store') }}" method="POST">
                    @csrf
                    @method('put')

                    First Name: <input type="text" name="first_name" value="{{ (isset($employee)) ? $employee->first_name : old('first_name') }}" required> 
                    @if($errors->has('first_name')) <p>{{ $errors->first('first_name') }}</p> @endif<br>
                    Last Name: <input type="text" name="last_name" value="{{ (isset($employee)) ? $employee->last_name : old('last_name') }}" required> 
                    @if($errors->has('last_name')) <p>{{ $errors->first('last_name') }}</p> @endif<br>
                    Address: <input type="text" name="address" value="{{ (isset($employee)) ? $employee->address : old('address') }}" required> 
                    @if($errors->has('address')) <p>{{ $errors->first('address') }}</p> @endif<br>
                    Phone: <input type="text" name="phone" value="{{ (isset($employee)) ? $employee->phone : old('phone') }}" required> 
                    @if($errors->has('phone')) <p>{{ $errors->first('phone') }}</p> @endif<br>
                    Department: 
                    <select class="department" name="department">
                        <option>---Select---</option>
                        @foreach($departments as $department)
                        @if(isset($employee) && $employee->department_id == $department->id)
                        <option value="{{ $department->id }}" selected="select">{{ $department->department_name }}</option>    
                        @else
                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>    
                        @endif
                        @endforeach
                    </select> <br>
                    Position: 
                    <select class="position" name="position">
                        <option>---Select---</option>
                    </select> <br>
                    Salary: <input type="text" name="salary" value="{{ (isset($employee)) ? $employee->salary : old('salary') }}" required> 
                    @if($errors->has('salary')) <p>{{ $errors->first('salary') }}</p> @endif<br><br>
                    <input type="hidden" class="positionid" value="{{ (isset($employee)) ? $employee->position_id : '' }}">
                    <input type="submit" name="save" value="{{ (isset($employee)) ? 'Update' : 'Create' }}"> <br>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
<script type="text/javascript">
    $(document).ready(function() {
        let $department = $('.department');
        let loadedDepartmentValue = $department.val();

        setPositions(loadedDepartmentValue);

        $department.on('change', function() {
            let selectedValue = this.value;

            if(selectedValue != 0) {
                setPositions(selectedValue);
            }
        });

        function setPositions(optionValue) {
            $.ajax({
                url: '/get-positions',
                data: {department_id: optionValue},
                dataType: 'json',
                success: function(data) {
                    let employeePosId = $('.positionid').val();

                    $('.position').find('option').remove().end().append('<option>--- Select ---</option>');

                    for(let i = 0; i < data.length; i++) {
                        if(employeePosId == data[i].id) {
                            $('.position').append('<option value="' + data[i].id + '" selected>' + data[i].position_name + '</option>');
                        } else {
                            $('.position').append('<option value="' + data[i].id + '">' + data[i].position_name + '</option>');
                        }
                    }
                }
            });
        }
    });
</script>