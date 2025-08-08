<?php
    use Illuminate\Support\Carbon;

    function getInitials($name) {
        $parts = explode(" ", $name);
        $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
        return $initials;
    }
    function getElapsedTime($dateParam, $referenceDate = null) {
        $start = new DateTime($dateParam);
        $end = $referenceDate ? new DateTime($referenceDate) : new DateTime(); // Default to today

        $diff = $start->diff($end); // This creates a DateInterval object

        return [
            'years' => $diff->y,
            'months' => $diff->m,
            'days' => $diff->d,
        ];
    }
    function isDuedate($dateParam){
        $inputDate   = Carbon::parse($dateParam)->startOfDay();
        $currentDate = Carbon::today();
        return $inputDate->lessThanOrEqualTo($currentDate);
    }
?>
