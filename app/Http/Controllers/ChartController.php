<?php
namespace App\Http\Controllers;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\HealthPlan;


class ChartController {

    // public static function generate_activity()
    // {
    //     $query = HealthPlan::where(['user_id'=> auth()->user()->id])->get();
       
    //     $first = 0;
    //     $second = 0;

    //     foreach ($query as $data) 
    //     {
    //         $entity = json_decode($data->result);

    //         if($entity->daily_meal_plan->breakfast->marked_by_user != 'none')
    //         {
    //             $first++;
    //         }

            
    //         if($entity->physical_activity->aerobic_excercise->marked_by_user != 'none')
    //         {
    //             $second++;
    //         }
    //     }


    //     $total_first = ($first/100) * $query->count();
    //     $total_second = ($second/100) * $query->count();


    //     return [$total_first, $total_second];

    // }

     public static function generate_activity()
    {
        $query = HealthPlan::orderByDesc('created_at')
            ->where('user_id', auth()?->user()?->id)
            ->first();

        $first = 0;

        if ($query?->result) {
            $risk = json_decode($query->result)?->diabeties_risk ?? '0%';

            // Remove the percentage symbol and cast to integer
            $first = $risk;
        }

        return $first;
    }

    public static function generate_chart()
    {
        $query = HealthPlan::where(['user_id' => auth()->user()->id])->get();

        $first = 0;
        $second = 0;

        foreach ($query as $data) {
            $entity = json_decode($data->result);

            if ($entity->daily_meal_plan->breakfast->marked_by_user != 'none') {
                $first++;
            }

            if ($entity->physical_activity->aerobic_excercise->marked_by_user != 'none') {
                $second++;
            }
        }

        // Percentage of total entries
        $total_first = $query->count() > 0 ? ($first / $query->count()) * 100 : 0;
        $total_second = $query->count() > 0 ? ($second / $query->count()) * 100 : 0;

        // Create chart
        $chart = new Chart;

        $chart->labels(['Meal Plan Followed', 'Exercise Done'])
            ->dataset('User Compliance (%)', 'line', [$total_first, $total_second])
            ->options([
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'fill' => true,
                'tension' => 0.4,
            ]);

        return $chart;
    }


}

?>