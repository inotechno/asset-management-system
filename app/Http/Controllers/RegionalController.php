<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RegionalController extends Controller
{
    public function index()
    {
        return view('components.regional');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            // $store = Store::where('user_id', auth()->user()->id)->first();
            $regionals = Regional::query();
            // dd($order);
            return DataTables::eloquent($regionals)
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
            Regional::create([
                'name'      => $request->name,
                'abbreviation'      => $request->abbreviation,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Regional created successfully',
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
        $regional = Regional::find($id);

        if (is_null($regional)) {
            return response()->json([
                'success' => false,
                'message' => 'Regional not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Regional retrieved successfully',
            'data' => $regional
        ]);
    }

    public function update(Request $request, $id)
    {
        $regional = Regional::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'abbreviation' => 'required',
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
            $regional->update([
                'name'      => $request->name,
                'abbreviation'      => $request->abbreviation,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Regional updated successfully',
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
        $regional = Regional::find($id);

        if (is_null($regional)) {
            return response()->json([
                'success' => false,
                'message' => 'Regional not found',
            ]);
        }

        try {
            $regional->delete();
            return response()->json([
                'success' => true,
                'message' => 'Regional deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
