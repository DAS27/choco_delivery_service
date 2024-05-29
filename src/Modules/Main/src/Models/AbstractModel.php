<?php

namespace SmartDelivery\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class AbstractModel extends Model
{
    use Actionable;
}
