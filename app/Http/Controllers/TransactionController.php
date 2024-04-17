<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    public function index()
    {
        return view('components.transaction');
    }

    public function create()
    {
        return view('components.create-transaction');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            // $store = Store::where('user_id', auth()->user()->id)->first();
            $companies = Transaction::with('employee', 'division', 'detail');
            // dd($order);
            return DataTables::eloquent($companies)
                ->addIndexColumn()
                ->addColumn('_status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="badge bg-success">IN</span>';
                    } else {
                        return '<span class="badge bg-danger">OUT</span>';
                    }
                })
                ->addColumn('_asset', function ($row) {
                    $asset = [];
                    foreach ($row->detail as $detail) {
                        $asset[] = $detail->asset->uid;
                    }

                    return $asset;
                })
                ->addColumn('action', function ($row) {
                    return '<ul class="list-unstyled hstack gap-1 mb-0">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <a href="#" class="btn btn-sm btn-soft-warning btn-view" data-id="' . $row->id . '"><i class="mdi mdi-eye-outline mdi-18px"></i></a>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Print PDF">
                                    <a href="' . route('transaction.pdf', $row->order_number) . '" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-file-pdf-box mdi-18px"></i></a>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <button data-id="' . $row->id . '" class="btn btn-sm btn-soft-danger btn-delete"><i class="mdi mdi-delete-outline mdi-18px"></i></button>
                                </li>
                            </ul>';
                })
                ->rawColumns(['action', '_status', '_asset'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $transaction = Transaction::with('employee', 'division', 'detail', 'detail.asset', 'detail.asset.category')->find($id);

        if (is_null($transaction)) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction retrieved successfully',
            'data' => $transaction
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'division_id' => 'required',
            'status' => 'required',
            'uid.*' => 'required',
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

        $error = [];
        foreach ($request->uid as $key => $value) {
            $check = Asset::find($value);
            if ($check->status == 0 && $request->status == 0) {
                $error[] = $check->uid . ' sudah standby';
            } else if ($check->status == 1 && $request->status == 1) {
                $error[] = $check->uid . ' tidak standby';
            }
        }

        if (!empty($error)) {
            return response()->json([
                'success' => false,
                'message' => $error,
            ]);
        }
        // dd($error);

        try {
            $transaction = Transaction::create([
                'order_number'  => date('dmYHis'),
                'employee_id'   => $request->employee_id,
                'division_id'   => $request->division_id,
                'note'          => $request->note,
                'status'        => $request->status
            ]);

            $detail = [];
            foreach ($request->uid as $key => $value) {

                Asset::find($value)->update([
                    'status' => $request->status
                ]);

                $detail[] = [
                    'transaction_id' => $transaction->id,
                    'asset_id'      => $value,
                    'created_at'    => date('Y-m-d H:i:s')
                ];
            }

            TransactionDetail::insert($detail);

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
                // 'data'     => $transaction
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
        $transaction = Transaction::find($id);

        if (is_null($transaction)) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ]);
        }


        try {
            $details = TransactionDetail::where("transaction_id", $id)->get();

            foreach ($details as $detail) {
                $status = 0;

                if ($transaction->status == 0) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                Asset::find($detail->asset_id)->update([
                    'status' => $status
                ]);
            }

            // dd($details);
            $transaction->delete();
            return response()->json([
                'success' => true,
                'message' => 'Transaction deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function exportPDF($order_number)
    {

        $transaction = Transaction::where('order_number', $order_number)->first();

        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $transaction->created_at->formatLocalized("%A, %d %B %Y");
        $transaction->date = $transaction->created_at->isoFormat('dddd, D MMMM Y');

        // return view('exports.receipt', compact('transaction'));
        $pdf = PDF::loadView('exports.receipt', ['transaction' => $transaction]);
        return $pdf->stream();
    }
}
