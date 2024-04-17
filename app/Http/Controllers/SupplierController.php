<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        return view('components.supplier');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $companies = Supplier::query();
            // dd($order);
            return DataTables::eloquent($companies)
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
            'name'  => 'required|unique:suppliers,name',
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
            Supplier::create([
                'name'      => $request->name,
                'telp'      => $request->telp,
                'url'      => $request->url,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supplier created successfully',
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
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Supplier retrieved successfully',
            'data' => $supplier
        ]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:suppliers,name,' . $supplier->id,
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
            $supplier->update([
                'name'      => $request->name,
                'telp'      => $request->telp,
                'url'      => $request->url,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supplier updated successfully',
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
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not found',
            ]);
        }

        try {
            $supplier->delete();
            return response()->json([
                'success' => true,
                'message' => 'Supplier deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
