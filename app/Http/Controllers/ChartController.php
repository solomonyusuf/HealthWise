<?php
namespace App\Http\Controllers;


use App\Models\HealthPlan;


class ChartController {

    public static function generate_activity()
    {
        $query = HealthPlan::where(['user_id'=> auth()->user()->id])->get();
       
        $first = 0;
        $second = 0;

        foreach ($query as $data) 
        {
            $entity = json_decode($data->result);

            if($entity->daily_meal_plan->breakfast->marked_by_user != 'none')
            {
                $first++;
            }

            
            if($entity->physical_activity->aerobic_excercise->marked_by_user != 'none')
            {
                $second++;
            }
        }


        $total_first = ($first/100) * $query->count();
        $total_second = ($second/100) * $query->count();


        return [$total_first, $total_second];

    }

}

?>