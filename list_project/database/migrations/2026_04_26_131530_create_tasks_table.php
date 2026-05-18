<?php
// migrations are versionc ontrol of the db schema in laravel
// lets you craete and modify db with php rather than sql
// can run the command php artisan make:migration "name" if you want custom named migrations
// running php artisan migrate will put this in place
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //up means going forward
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // down means rolling back
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
