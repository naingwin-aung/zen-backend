<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('storeImage')) {
    function storeImage(string $folderName, $image, $path = 'public')
    {
        return Storage::put($folderName, $image, $path);
    }
}

if (! function_exists('copyStoredImage')) {
    /**
     * Duplicate an already stored image so a cloned record owns its own file.
     */
    function copyStoredImage(string $folderName, ?string $sourcePath, string $visibility = 'public'): ?string
    {
        if (empty($sourcePath)) {
            return null;
        }

        // externally hosted images are referenced by URL, so the copy can share it
        if (Str::startsWith($sourcePath, 'http')) {
            return $sourcePath;
        }

        if (! Storage::exists($sourcePath)) {
            return null;
        }

        $extension = pathinfo($sourcePath, PATHINFO_EXTENSION);
        $newPath = $folderName.'/'.Str::random(40).($extension ? '.'.$extension : '');

        Storage::copy($sourcePath, $newPath);
        Storage::setVisibility($newPath, $visibility);

        return $newPath;
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
