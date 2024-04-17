<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('components.employee');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            // $store = Store::where('user_id', auth()->user()->id)->first();
            $employees = Employee::query();
            // dd($order);
            return DataTables::eloquent($employees)
                ->addIndexColumn()

                ->addColumn('_address', function ($row) {
                    return substr($row->address, 0, 100);
                })
                ->addColumn('action', function ($row) {
                    return '<ul class="list-unstyled hstack gap-1 mb-0">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <a href="job-details.html" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline mdi-18px"></i></a>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <button class="btn btn-sm btn-soft-info btn-edit" data-id="' . $row->id . '"><i class="mdi mdi-pencil-outline mdi-18px"></i></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <button data-id="' . $row->id . '" class="btn btn-sm btn-soft-danger btn-delete"><i class="mdi mdi-delete-outline mdi-18px"></i></button>
                                </li>
                            </ul>';
                })
                ->rawColumns(['action', '_address'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'hp'    => 'required|numeric|min:8',
            'email' => 'required|email:dns'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Bad parameter!',
                'data' => [
                    'error' => $validator->errors()
                ]
            ]);
        }

        try {
            Employee::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'hp'        => $request->hp,
                'address'   => $request->address,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Employee created successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee retrieved successfully',
            'data' => $employee
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'hp'    => 'required|numeric|min:8',
            'email' => 'required|email:dns'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bad parameter!',
                'data' => [
                    'error' => $validator->errors()
                ]
            ]);
        }

        try {
            $employee->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'hp'        => $request->hp,
                'address'   => $request->address,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
            ]);
        }

        try {
            $employee->delete();
            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
