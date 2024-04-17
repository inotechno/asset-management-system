<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function category(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $categories = Category::orderby('name', 'asc')->select('id', 'name')->limit(10)->get();
        } else {
            $categories = Category::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($categories as $category) {
            $response[] = array(
                "id" => $category->id,
                "text" => $category->name
            );
        }

        return response()->json($response);
    }

    public function supplier(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $suppliers = Supplier::orderby('name', 'asc')->select('id', 'name')->limit(10)->get();
        } else {
            $suppliers = Supplier::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($suppliers as $supplier) {
            $response[] = array(
                "id" => $supplier->id,
                "text" => $supplier->name
            );
        }

        return response()->json($response);
    }

    public function employee(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $employees = Employee::orderby('name', 'asc')->select('id', 'name')->limit(10)->get();
        } else {
            $employees = Employee::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->name
            );
        }

        return response()->json($response);
    }

    public function division(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $divisions = Division::with('company')->orderby('name', 'asc')->select('id', 'name', 'company_id')->limit(10)->get();
        } else {
            $divisions = Division::with('company')->orderby('name', 'asc')->select('id', 'name', 'company_id')->where('name', 'like', '%' . $search . '%')->orWhereHas('company', function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->limit(10)->get();
        }

        // dd($divisions);
        $response = array();
        foreach ($divisions as $division) {
            $response[] = array(
                "id" => $division->id,
                "text" => $division->name . ' - ' . $division->company->name
            );
        }

        return response()->json($response);
    }

    public function asset(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $assets = Asset::orderby('uid', 'asc')->select('id', 'uid')->limit(10)->get();
        } else {
            $assets = Asset::orderby('uid', 'asc')->select('id', 'uid')->where('uid', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($assets as $asset) {
            $response[] = array(
                "id" => $asset->id,
                "text" => $asset->uid
            );
        }

        return response()->json($response);
    }

    public function assetById($id)
    {
        $asset = Asset::with('category')->find($id);
        return response()->json($asset);
    }
}
