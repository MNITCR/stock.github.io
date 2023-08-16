<?php

namespace App\Http\Controllers;
use App\Models\PurchaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;



class ReportController extends Controller
{
    public function index(){
        $rep = PurchaseModel::paginate(5);
        return view('report.report', compact('rep'));
    }

    // edit
    public function updateRep(Request $request, $id) {
        $record = PurchaseModel::find($id);

        if (!$record) {
            return response()->json([
                'message' => 'Record not found'
            ], 404);
        }

        $data = $request->only(['pocode', 'dis', 'tax', 'total', 'grand_total', 'date']);
        $record->update($data);

        return response()->json([
            'message' => 'Record updated successfully',
            'record' => $record
        ]);
    }

    // search for date to date
    public function searchReports(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $results = PurchaseModel::whereBetween('date', [$fromDate, $toDate])->get();

        return response()->json(['data' => $results]);
    }

    // delete purchase
    public function delete($id){
        $po_id = PurchaseModel::find($id);
        if ($po_id) {
            $po_id->delete();
            return redirect()->route('report')->with(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
