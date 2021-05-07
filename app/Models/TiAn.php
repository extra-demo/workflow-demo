<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class TiAn extends Model
{
    use HasFactory;

    use WorkflowTrait;

    public $table = "ti_an";
}
