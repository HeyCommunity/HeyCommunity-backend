<?php

namespace App\Models\Analytics;

use Illuminate\Support\Facades\DB;

class AnalyticsBase
{
    public static function makeChartConfigure($startDate, $endDate, $items)
    {
        $labelDate = $startDate->clone();
        $dateList = [];
        $labels = [];
        do {
            $dateList[] = $labelDate->format('Y-m-d');
            $labels[] = $labelDate->format('m/d');
        } while ($labelDate->addDay() <= $endDate);

        $datasets = [];
        foreach ($items as $labelModel => $labelConfig) {
            $labelData = (new $labelModel)->query()
                ->select([
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(*) as count'),
                ])
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')->orderBy('date')
                ->get()
                ->pluck('count', 'date')->toArray();

            $dataset = [
                'label' =>  $labelConfig['name'],
                'data'  =>  self::serializeData($dateList, $labelData),
            ];
            if (isset($labelConfig['color'])) $dataset['borderColor'] = $labelConfig['color'];

            $datasets[] = $dataset;
        }

        return [
            'labels'    =>  $labels,
            'datasets'  =>  $datasets,
        ];
    }

    public static function serializeData($dateList, $data)
    {
        $result = [];
        foreach ($dateList as $index => $date) {
            $result[$date] = $data[$date] ?? 0;
        }

        return array_values($result);
    }
}
