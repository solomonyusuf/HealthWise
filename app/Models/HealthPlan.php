<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HealthPlan
 * 
 * @property string $id
 * @property string $user_id
 * @property string|null $info
 * @property string|null $result
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class HealthPlan extends Model
{
	use HasUuids;
	protected $table = 'health_plans';
	public $incrementing = false;

	protected $fillable = [
		'user_id',
		'info',
		'result'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
