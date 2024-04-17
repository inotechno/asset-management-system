<?php

namespace App\Http\Controllers;

use DNS2D;
use App\Models\Asset;
use App\Models\AssetImages;
use App\Models\Category;
use App\Models\Supplier;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function index()
    {
        // echo DNS2D::getBarcodeHTML('https://psikotesdaring.com', 'QRCODE');
        // echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('454541255', 'I25+', 2, 40, array(1, 1, 1), true) . '" alt="barcode"   />';
        // die;
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('components.asset', compact('categories', 'suppliers'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            // $store = Store::where('user_id', auth()->user()->id)->first();
            $assets = Asset::with('category', 'supplier', 'image');
            // dd($order);
            return DataTables::eloquent($assets)
                ->addIndexColumn()
                ->addColumn('_status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="badge bg-success">Standby</span>';
                    } else {
                        return '<span class="badge bg-danger">Not Standby</span>';
                    }
                })
                ->addColumn('_barcode', function ($row) {
                    return '<img class="img-fluid" src="data:image/png;base64,' . DNS1D::getBarcodePNG($row->uid, 'I25+', 2, 40, array(1, 1, 1), true) . '" alt="barcode"   />';
                })
                ->addColumn('_images', function ($row) {
                    $html = '';
                    foreach ($row->image as $key => $image) {
                        $html .= '  <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block image-asset">
                                            <img src="' . asset('images/assets/' . $image->name) . '" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                    </div>';
                    }

                    return '<div class="avatar-group">' . $html . '</div>';
                })
                ->addColumn('action', function ($row) {
                    return '<ul class="list-unstyled hstack gap-1 mb-0">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <button class="btn btn-sm btn-soft-primary btn-view" data-id="' . $row->id . '"><i class="mdi mdi-eye-outline mdi-18px"></i></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <button class="btn btn-sm btn-soft-info btn-edit" data-id="' . $row->id . '"><i class="mdi mdi-pencil-outline mdi-18px"></i></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <button data-id="' . $row->id . '" class="btn btn-sm btn-soft-danger btn-delete"><i class="mdi mdi-delete-outline mdi-18px"></i></button>
                                </li>
                            </ul>';
                })
                ->rawColumns(['action', '_status', '_barcode', '_images'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'supplier_id' => 'required',
            'specification' => 'required',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric',
            'condition' => 'required',
            'foto1'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto2'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto3'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto4'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto5'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // dd($request);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Bad parameter!',
                'data' => [
                    'error' => $validator->errors()
                ]
            ]);
        }

        $category = $request->category_id;
        $supplier = $request->supplier_id;

        $cat = Category::where('id', $request->category_id)->count();
        // dd($cat);
        if ($cat == 0) {
            $inCategory = Category::create([
                'name' => $request->category_id
            ]);

            $category = $inCategory->id;
        }

        $sup = Supplier::where('id', $request->supplier_id)->count();
        // dd($supplier);
        if ($sup == 0) {
            $inSupplier = Supplier::create([
                'name' => $request->supplier_id
            ]);

            $supplier = $inSupplier->id;
        }

        $foto1 = $request->file('foto1');
        $foto2 = $request->file('foto2');
        $foto3 = $request->file('foto3');
        $foto4 = $request->file('foto4');
        $foto5 = $request->file('foto5');

        $images = [];

        if ($foto1) {
            $images[1] = time() . '1.' . $foto1->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto1->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[1]);
        }

        if ($foto2) {
            $images[2] = time() . '2.' . $foto2->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto2->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[2]);
        }

        if ($foto3) {
            $images[3] = time() . '3.' . $foto3->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto3->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[3]);
        }

        if ($foto4) {
            $images[4] = time() . '4.' . $foto4->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto4->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[4]);
        }

        if ($foto5) {
            $images[5] = time() . '5.' . $foto5->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto5->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[5]);
        }

        // dd($images);
        try {
            $asset = Asset::create([
                'category_id'      => intval($category),
                'supplier_id'      => intval($supplier),
                'uid'              => date('dmYHis'),
                'specification'    => $request->specification,
                'production_year'  => $request->production_year,
                'purchase_date'    => $request->purchase_date,
                'purchase_price'   => $request->purchase_price,
                'condition'        => $request->condition,
            ]);

            foreach ($images as $key => $image) {
                AssetImages::create([
                    'asset_id'  => $asset->id,
                    'name'      => $image
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Asset created successfully',
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
        $asset = Asset::with('image', 'category', 'supplier')->find($id);

        if (is_null($asset)) {
            return response()->json([
                'success' => false,
                'message' => 'Asset not found',
            ]);
        }

        $asset->barcode =
            '<img class="img-fluid" src="data:image/png;base64,' . DNS1D::getBarcodePNG($asset->uid, 'I25+', 2, 40, array(1, 1, 1), true) . '" alt="barcode"   />';

        return response()->json([
            'success' => true,
            'message' => 'Asset retrieved successfully',
            'data' => $asset
        ]);
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::find($id);

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'supplier_id' => 'required',
            'specification' => 'required',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric',
            'condition' => 'required',
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

        $foto1 = $request->file('foto1');
        $foto2 = $request->file('foto2');
        $foto3 = $request->file('foto3');
        $foto4 = $request->file('foto4');
        $foto5 = $request->file('foto5');

        $images = [];

        if ($foto1) {
            $images[1] = time() . '1.' . $foto1->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto1->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[1]);

            unlink('images/assets/' . $request->foto1_old);
            $foto1 = AssetImages::where('name', $request->foto1_old)->delete();
        }

        if ($foto2) {
            $images[2] = time() . '2.' . $foto2->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto2->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[2]);

            unlink('images/assets/' . $request->foto2_old);
            $foto2 = AssetImages::where('name', $request->foto2_old)->delete();
        }

        if ($foto3) {
            $images[3] = time() . '3.' . $foto3->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto3->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[3]);

            unlink('images/assets/' . $request->foto3_old);
            $foto3 = AssetImages::where('name', $request->foto3_old)->delete();
        }

        if ($foto4) {
            $images[4] = time() . '4.' . $foto4->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto4->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[4]);

            unlink('images/assets/' . $request->foto4_old);
            $foto4 = AssetImages::where('name', $request->foto4_old)->delete();
        }

        if ($foto5) {
            $images[5] = time() . '5.' . $foto5->extension();

            $destinationPath = public_path('/images/assets');
            $img = Image::make($foto5->path());
            $img->resize(480, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images[5]);

            unlink('images/assets/' . $request->foto5_old);
            $foto5 = AssetImages::where('name', $request->foto5_old)->delete();
        }

        try {
            $asset->update([
                'category_id'      => $request->category_id,
                'supplier_id'      => $request->supplier_id,
                'specification'      => $request->specification,
                'production_year'      => $request->production_year,
                'purchase_date'      => $request->purchase_date,
                'purchase_price'      => $request->purchase_price,
                'condition'      => $request->condition,
            ]);

            foreach ($images as $key => $image) {
                AssetImages::create([
                    'asset_id'  => $asset->id,
                    'name'      => $image
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Asset updated successfully',
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
        $asset = Asset::find($id);

        if (is_null($asset)) {
            return response()->json([
                'success' => false,
                'message' => 'Asset not found',
            ]);
        }

        try {
            foreach ($asset->Image as $key => $image) {
                unlink('images/assets/' . $image->name);
            }

            $asset->delete();
            return response()->json([
                'success' => true,
                'message' => 'Asset deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
