<?php

namespace MCris112\Billable\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use MCris112\Billable\Observers\OrderObserver;
use Resources\Order\OrderResource;

/**
 * MCris112\Billable\Models\Order
 *
 * @property string $id
 * @property int $user_id
 * @property string|null $preference_id
 * @property string|null $preference_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \MCris112\Billable\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \MCris112\Billable\Models\OrderStatus> $statuses
 * @property-read int|null $statuses_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePreferenceContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePreferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'payment_method_provider_id',
        'totals_currency_code',
        'totals_amount'
    ];

    protected $keyType = 'string';

    public function getTable(): string
    {
        return config('billable.table.prefix').'orders';
    }

    public static function getUserColumnsAsText()
    {
        return 'user:'.implode(',', config('billable.order.user.columns', ['id']));
    }

    public function toResource()
    {
        return new OrderResource($this);
    }

    /*-------------------------
    -
    -  RELATIONS
    -
    -------------------------*/


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
