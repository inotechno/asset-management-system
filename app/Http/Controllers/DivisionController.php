<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Division;
use App\Models\Regional;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    public function index()
    {
        $regionals = Regional::all();
        $companies = Company::all();

        return view('components.division', compact('regionals', 'companies'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            // $store = Store::where('user_id', auth()->user()->id)->first();
            $divisions = Division::with('regional', 'company');
            // dd($order);
            return DataTables::eloquent($divisions)
                ->addIndexColumn()

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
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'abbreviation' => 'required',
            'company_id' => 'required',
            'regional_id' => 'required',
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
            Division::create([
                'name'      => $request->name,
                'abbreviation'      => $request->abbreviation,
                'company_id'      => $request->company_id,
                'regional_id'      => $request->regional_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Division created successfully',
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
        $division = Division::find($id);

        if (is_null($division)) {
            return response()->json([
                'success' => false,
                'message' => 'Division not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Division retrieved successfully',
            'data' => $division
        ]);
    }

    public function update(Request $request, $id)
    {
        $division = Division::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'abbreviation' => 'required',
            'company_id' => 'required',
            'regional_id' => 'required',
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
            $division->update([
                'name'      => $request->name,
                'abbreviation'      => $request->abbreviation,
                'company_id'      => $request->company_id,
                'regional_id'      => $request->regional_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Division updated successfully',
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
        $division = Division::find($id);

        if (is_null($division)) {
            return response()->json([
                'success' => false,
                'message' => 'Division not found',
            ]);
        }

        try {
            $division->delete();
            return response()->json([
                'success' => true,
                'message' => 'Division deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
