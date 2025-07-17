<?php

use App\Http\Controllers\UploadController;
use App\Models\HealthPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });

    Route::get('/track-glucose', function () {
        return view('pages.track-glucose');

    });
    Route::get('/result', function () {
        
        $plan = HealthPlan::orderByDesc('created_at')->where(['user_id'=> auth()?->user()?->id])->first();
    
        return view('pages.result', ['plan' => $plan, 'result' => json_decode($plan?->result)]);

    })->name('result');

    Route::post('/generate-result', function (Request $request) {
        $endpoint = env('GITHUB_MODEL_ENDPOINT');
            $apiKey   = env('GITHUB_MODEL_KEY');
            $model    = env('GITHUB_MODEL_NAME');
            $input = json_encode($request->all());

            if($request?->result)
            $input = json_encode(HealthPlan::find($request?->result)?->info);

            $payload = [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "You are a Nigerian health assistant AI. Based on the user's health profile, return a  JSON response alone. 

                                    - The values must be dynamic and personalized based on input.  
                                    - The diet plan must only include Nigerian foods.  
                                    - Do not include any non-Nigerian meals.  
                                    - Respond with only raw JSON. No code blocks. No extra text. No triple quotes.  
                                    - Follow this exact JSON response structure and naming:

                                    {
                                    'diabeties_risk' : '..respond in percentage figure alone eg 44%',
                                    'daibeties_status': 'explain something here but you must say the status diabetic or non-diabetic...',
                                    'daily_meal_plan': 
                                    {
                                        'breakfast': 
                                        {
                                        'time': '7am',
                                        'food': 'e.g., Moi Moi and pap',
                                        'food_class': 'High fiber, low fat',
                                        'marked_by_user': 'none'
                                        },
                                        'mid_breakfast': 
                                        {
                                        'time': '10am',
                                        'food': 'e.g., boiled corn with pear',
                                        'food_class': 'Fiber-rich traditional snack',
                                        'marked_by_user': 'none'
                                        },
                                        'lunch': 
                                        {
                                        'time': '1pm',
                                        'food': 'e.g., Ofada rice with vegetables and grilled fish',
                                        'food_class': 'Local balanced Nigerian meal',
                                        'marked_by_user': 'none'
                                        },
                                        'afternoon_snack': {
                                        'time': '4pm',
                                        'food': 'e.g., groundnuts and banana',
                                        'food_class': 'Energy-boosting light meal',
                                        'marked_by_user': 'none'
                                        },
                                        'dinner': {
                                        'time': '7pm',
                                        'food': 'e.g., vegetable soup with wheat swallow',
                                        'food_class': 'Light, fiber-rich Nigerian dinner',
                                        'marked_by_user': 'none'
                                        }
                                    },
                                    'physical_activity': {
                                        'aerobic_excercise': {
                                        'walk': 'e.g., 20 minutes, 3 days/week',
                                        'action_1': 'e.g., walking around compound',
                                        'action_2': 'e.g., dancing to music indoors',
                                        'action_3': 'e.g., climbing stairs',
                                        'marked_by_user': 'none'
                                        },
                                        'strength_tranning': {
                                        'duration': '15-20 minutes, 3 days/week',
                                        'action_1': 'e.g., using water bottles as weights',
                                        'action_2': 'e.g., chair squats',
                                        'action_3': 'e.g., resistance band rows',
                                        'marked_by_user': 'none'
                                        }
                                    }

                                    Now generate the result Respond with only raw JSON. No code blocks. No extra text. No triple quotes
                                    }"
                                            ],
                                            [
                                                'role' => 'user',
                                                'content' => $input  // Example below
                                            ]
                                        ],
                                        'temperature' => 0.7,
                                        'top_p' => 1.0,
                                    ];

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post($endpoint, $payload);

            $result = $response['choices'][0]['message']['content'];
            $clean = preg_replace('/^["`\s]*|["`\s]*$/', '', $result);

            // Step 2: Replace single quotes with double quotes (if needed)
            $clean = str_replace("'", '"', $clean);
            $parsed = json_decode($clean);
            
            HealthPlan::create([
                'user_id' => auth()?->user()?->id,
                'info' => $input,
                'result'=> json_encode($parsed)
            ]);  
        
        return redirect()->route('result');

    })->name('ai_result');

    Route::post('/update_result/{id}', function (Request $request, $id) {
        $entity = HealthPlan::find($id);
        $result = json_decode($entity?->result);
        
        if($request->breakfast_mark)
            $result->daily_meal_plan->breakfast->marked_by_user = 'yes'; 
        if($request->mid_breakfast_mark)
            $result->daily_meal_plan->mid_breakfast->marked_by_user = 'yes'; 
        if($request->lunch_mark)
            $result->daily_meal_plan->lunch->marked_by_user = 'yes'; 
        if($request->afternoon_snack_mark)
            $result->daily_meal_plan->afternoon_snack->marked_by_user = 'yes'; 
        if($request->dinner_mark)
            $result->daily_meal_plan->dinner->marked_by_user = 'yes'; 
        
        if($request->aerobic_mark)
            $result->physical_activity->aerobic_excercise->marked_by_user = 'yes'; 
        if($request->strength_tranning_mark)
            $result->physical_activity->strength_tranning->marked_by_user = 'yes'; 

        $entity->result = json_encode($result);

        $entity->save();
        
        return redirect()->back();

    })->name('update_result');
    
    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');

});


Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::post('/post-login', function (Request $request) {
    
            $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

})->name('post_login');

Route::post('/post-register', function (Request $request) {
   
           $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $image = UploadController::UploadFile($request);

        $user = User::create([
            'image' => $image ?? 'https://img.icons8.com/?size=100&id=23265&format=png&color=000000',
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');

})->name('post_register');

