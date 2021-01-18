<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;

class EmployeeController extends Controller
{
	public function employeesList() {
		$employees = DB::select('SELECT e.id, first_name, last_name, address, phone, d.department_name, p.position_name, salary 
			FROM employees as e 
			LEFT JOIN departments as d on e.department_id = d.id 
			LEFT JOIN positions as p on p.department_id = d.id 
			WHERE position_id = p.id');

		return view('employees', ['employees' => $employees]);
	}

	public function addEmployee() {
		$departments = Department::get();

		return view('add', ['departments' => $departments]);
	}

	public function deleteEmployee($id) {
		if(Employee::destroy($id)) {
			return redirect('employees')->with('message', 'Employee deleted successfully.');
		}

		return redirect('employees')->with('message', 'Employee does not exist.');
	}

	public function editEmployee($id) {
		$departments = Department::get();
		$employee = Employee::find($id);

		return view('add', ['departments' => $departments, 'employee' => $employee]);
	}

	public function storeEmployee(Request $request) {
		$employeeId = substr(url()->previous(), strrpos(url()->previous(), '/') + 1);
		$urlPath = parse_url(url()->previous())['path'];
		$operationMethod = preg_split("#/#", $urlPath); 

		if($employeeId != 0) {
			$employee = Employee::find($employeeId);
		} else {
			$employee = new Employee;
		}

		$employees = Employee::all();

		$validator = Validator::make($request->all(), [
			'first_name' => 'required|max:15',
			'last_name' => 'required|max:15',
			'address' => 'required|max:50',
			'phone' => 'required|numeric',
			'department' => 'required|numeric',
			'position' => 'required|numeric',
			'salary' => 'required|numeric',
		]);

		if($validator->fails()) {
			if($operationMethod[1] == 'add') {
				return redirect('/add')
					->withErrors($validator)
					->withInput();
			} elseif($operationMethod[1] == 'edit') {
				return redirect('/edit/'.$operationMethod[2])
					->withErrors($validator)
					->withInput();
			}
		}

		$employee->first_name = $request->first_name;
		$employee->last_name = $request->last_name;
		$employee->address = $request->address;
		$employee->phone = $request->phone;
		$employee->department_id = $request->department;
		$employee->position_id = $request->position;
		$employee->salary = $request->salary;

		if($employeeId != 0) {
			$employee->update();

			$message = 'Employee updated successfully.';
		} else {
			$employee->save();

			$message = 'Employee created successfully.';
		}

		return redirect('/employees')->with('message', $message)->with('employees', $employees);
	}

	public function getPositions() {
		$positions = Position::select('id', 'department_id', 'position_name')->where('department_id', $_GET['department_id'])->get();

		return view('get-positions', ['positions' => $positions]);
	}
}
