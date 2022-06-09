<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use pieter365\Firebase\SyncsWithFirebase;

class TODo extends Model
{
    use HasFactory,SyncsWithFirebase;
}
