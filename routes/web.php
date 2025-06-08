<?php

use App\Http\Controllers\UploadController;
use App\Models\HealthPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
                    ['role' => 'system', 'content' => "based on this input fields generate {$input}"],
                    ['role' => 'system', 'content' => "return your response in json follow this pattern 
                    {
                        'daibeties_status' : 'explain something here but you must say the status diabetic or non-diabetic...',
                        'daily_meal_plan': {
                            'breakfast': {
                                'time' : '7am',
                                'food' : 'Egg white omelet with spinach and whole grain toast',
                                'food_class' : 'High protein, low calorie breakfast',
                                'marked_by_user': 'none'
                        
                            },
                            'mid_breakfast': {
                                'time' : '10am',
                                'food' : 'Greek yogurt with berries',
                                'food_class' : 'Protein-rich snack with antioxidants',
                                'marked_by_user': 'none'
                            },
                            'lunch': {
                                'time' : '1pm',
                                'food' : 'Grilled chicken salad with olive oil dressing',
                                'food_class' : 'Lean protein with fiber-rich vegetables',
                                'marked_by_user': 'none'
                            },
                            'afternoon_snack': {
                                'time' : '4pm',
                                'food' : 'Apple slices with almond butter',
                                'food_class' : 'Balanced energy boost',
                                'marked_by_user': 'none'
                            },
                            'dinner': {
                                'time' : '7pm',
                                'food' : 'Baked fish with steamed vegetables',
                                'food_class' : 'Low-calorie, high-protein dinner',
                                'marked_by_user': 'none'
                            },
                        },
                        'physical_activity': {
                            'aerobic_excercise' : {
                                'walk' : '20 minutes, 3 days/week',
                                'action_1': 'Light walking',
                                'action_2': 'Swimming',
                                'action_3': 'Stationary cycling at low intensity',
                                'marked_by_user': 'none'
                            },
                            'strength_tranning' : {
                                'duration' : '15-20 minutes, 3 days/week',
                                'action_1': 'Light resistance bands',
                                'action_2': 'Chair exercises',
                                'action_3': 'Gentle stretching',
                                'marked_by_user': 'none'
                            }

                        }
                    }"
                ],
                    ['role' => 'user', 'content' => 'Hello'],
                ],
                'temperature' => 1.0,
                'top_p' => 1.0,
            ];

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post($endpoint, $payload);

            $result = $response['choices'][0]['message']['content'];
            
            HealthPlan::create([
                'user_id' => auth()?->user()?->id,
                'info' => $input,
                'result'=> $result
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

        $user = User::create([
            'image' => UploadController::UploadFile($request),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');

})->name('post_register');

