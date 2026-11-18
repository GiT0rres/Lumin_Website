<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'message', 'status'])]
class Recommendation extends Model
{
    public const STATUSES = ['pendente', 'aprovada', 'rejeitada'];
}
