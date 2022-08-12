<?php

namespace App\Models\Analytics;

use Illuminate\Support\Facades\DB;

class AnalyticsBase
{
    /**
     * 生成 LineChart 配置
     *
     * @param $startDate
     * @param $endDate
     * @param $items
     * @return array
     */
    public static function makeLineChartConfigure($startDate, $endDate, $items): array
    {
        $analyticsBase = new self();

        return [
            'type'  =>  'line',
            'data'  =>  [
                'labels'    =>  $analyticsBase->makeDateList($startDate, $endDate, 'n/j'),
                'datasets'  =>  $analyticsBase->makeDatasets($startDate, $endDate, $items),
            ],
        ];
    }

    /**
     * 生成 datasets
     *
     * $labels = [
     *  'labelClassName' => [
     *      'name'          =>  '用户增长',
     *      'color'         =>  '2c7be5',         // 选填，默认 #2c7be5
     *      'date_column'   =>  'created_at',     // 选填，默认 created_at
     *      'count_column'  =>  '*',              // 选填，默认 *
     *  ]
     * ]
     *
     * @param $startDate
     * @param $endDate
     * @param $labels
     * @return array
     */
    protected function makeDatasets($startDate, $endDate, $labels): array
    {
        $datasets = [];

        foreach ($labels as $label) {
            $label['date_column'] ??= 'created_at';
            $label['count_column'] ??= '*';

            $labelData = (new $label['class']())->query()
                ->select([
                    DB::raw('DATE(' . $label['date_column'] . ') as date'),
                    DB::raw('COUNT(' . $label['count_column'] . ') as count'),
                ])
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')->orderBy('date')
                ->get()
                ->pluck('count', 'date')->toArray();

            $dataset = [
                'label' =>  $label['name'],
                'data'  =>  $this->fillDataForDate(
                    $this->makeDateList($startDate, $endDate, 'Y-m-d'),
                    $labelData,
                ),
            ];

            if (isset($label['color'])) {
                $dataset['borderColor'] = $label['color'];
            }

            $dataset['hidden'] = $label['hidden'] ?? false;

            $datasets[] = $dataset;
        }

        return $datasets;
    }

    /**
     * 按指定的格式生成从开始时间到结束时间的连续日期列表，如 ['2022-02-22', '2022-02-23', '...', '2022-02-30']
     *
     * @param $startDate
     * @param $endDate
     * @param string $format
     * @return array
     */
    protected function makeDateList($startDate, $endDate, string $format = 'Y-m-d'): array
    {
        $labelDate = $startDate->clone();
        $dateList = [];

        do {
            $dateList[] = $labelDate->format($format);
        } while ($labelDate->addDay() <= $endDate);

        return $dateList;
    }

    /**
     * 为日期填充数据
     *
     * @param $dateList     ['2022-02-20', '2022-02-21', '2022-02-22']
     * @param $data         ['2022-02-22' => 123]
     * @return array        ['2022-02-20' => 0, '2022-02-21' => 0, '2022-02-22' => 123]
     */
    protected function fillDataForDate($dateList, $data): array
    {
        $result = [];
        foreach ($dateList as $date) {
            $result[$date] = $data[$date] ?? 0;
        }

        return array_values($result);
    }
}
