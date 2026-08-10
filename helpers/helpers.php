<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

if (! function_exists('storeImage')) {
    function storeImage(string $folderName, $image, $path = 'public')
    {
        return Storage::put($folderName, $image, $path);
    }
}

if (! function_exists('generateDatesFromClosingDays')) {
    function generateDatesFromClosingDays($closingDays, $startDate, $endDate)
    {
        $dates = [];
        $realStart = Carbon::parse($startDate);

        $start = $realStart->isPast() ? today() : $realStart->startOfDay();
        $end = Carbon::parse($endDate)->startOfDay();

        if ($end->lt(today())) {
            return [];
        }

        foreach ($closingDays as $closingDay) {
            $dayName = $closingDay;

            $dayMapping = [
                'Sunday' => Carbon::SUNDAY,
                'Monday' => Carbon::MONDAY,
                'Tuesday' => Carbon::TUESDAY,
                'Wednesday' => Carbon::WEDNESDAY,
                'Thursday' => Carbon::THURSDAY,
                'Friday' => Carbon::FRIDAY,
                'Saturday' => Carbon::SATURDAY,
            ];

            if (isset($dayMapping[$dayName])) {
                $targetDay = $dayMapping[$dayName];
                $current = $start->copy();

                if ($current->dayOfWeek !== $targetDay) {
                    $current->next($targetDay);
                }

                while ($current->lte($end)) {
                    if ($current->gte(today())) {
                        $dates[] = $current->format('Y-m-d');
                    }
                    $current->addWeek();
                }
            }
        }

        sort($dates);

        return array_values(array_unique($dates));
    }
}
