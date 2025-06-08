<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 * 
 * @property string $id
 * @property string $image
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HealthPlan[] $health_plans
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	
    use HasApiTokens, HasFactory, Notifiable, HasUuids;
	protected $table = 'users';
	public $incrementing = false;

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'image',
		'first_name',
		'last_name',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function health_plans()
	{
		return $this->hasMany(HealthPlan::class);
	}
}
