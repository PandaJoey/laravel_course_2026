<?php
//this was created by typing php artisan make:model Task -m in the terminal
//-m creates the file and puts it in the models folder
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Override;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'long_description',
    ];

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}
