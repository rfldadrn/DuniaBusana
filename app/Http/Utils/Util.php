<?php

use App\Models\AuditTrails;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


    function getInitials($name)
    {
        $parts = explode(" ", $name);
        $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
        return $initials;
    }
    function getElapsedTime($dateParam, $referenceDate = null)
    {
        $start = new DateTime($dateParam);
        $end = $referenceDate ? new DateTime($referenceDate) : new DateTime(); // Default to today

        $diff = $start->diff($end); // This creates a DateInterval object

        return [
            'years' => $diff->y,
            'months' => $diff->m,
            'days' => $diff->d,
        ];
    }
    function isDuedate($dateParam)
    {
        $inputDate   = Carbon::parse($dateParam)->startOfDay();
        $currentDate = Carbon::today();
        return $inputDate->lessThanOrEqualTo($currentDate);
    }

    function formatRupiah($value)
    {
        $value = 'Rp. ' . number_format($value, 0, ',', '.');
        echo $value; // Output: Rp 1.500.000

    }
    function createAuditTrail($feature,$data_id,$detail)
    {
        $validator = Validator::make([
        'feature' => $feature,
        'data_id' => $data_id,
        'detail' => $detail,
        'created_by' => Auth::id(),
        ], [
            'feature' => 'required|string|max:255',
            'data_id' => 'required|integer',
            'detail' => 'required|string',
            'created_by' => 'required|integer',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        AuditTrails::create($validator->validated());
    }

    function getAuditTrails($feature,$id)
    {
        if($feature == 1){
            $feature = "transaction";
        }elseif ($feature == 2) {
            $feature = "payment";
        }
        return $result = AuditTrails::with('creator')
        ->where('feature','=',$feature)
        ->where('data_id','=',$id)
        ->orderByDesc('id')
        ->get();
    }

    function setWorkflow($trId)
    {
        $items = DetailTransaction::where('transaction_id','=',$trId);
        $status_id = 1;
        if (!$items) {
            throw new \Exception("Items not found.");
        }

        $statuses = $items->pluck('status_order_item_id')->unique();
        $statusProgress = collect([1,2,3,4,5]);

        if ($statuses->count() === 1 && $statuses->first() === 6) { //Siap diambil
            $status_id = 3;
        } elseif ($statuses->intersect($statusProgress)->isNotEmpty()) {
            $status_id = 2;
        } elseif ($statuses->contains(8)) {
            $status_id = 6; // fallback if needed
        } else {
            $status_id = 4;
        }
        return $status_id;
    }
?>
