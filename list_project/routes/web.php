<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use \App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

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

// redirects to the main page if a wrong url is entered
Route::get('/', function () {
    return redirect()->route('tasks.index');
});


//latest is a query builder which lets you filter sql db
Route::get('/tasks', function () {
    return view('index', ['tasks' => Task::latest()->paginate(10)]);
})->name('tasks.index');


Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', ['task' => $task,]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task) {
    return view('show', ['task' => $task,]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request) {


    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully!');

})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');


//Route::fallback(function () {
  //  return 'Still got somewhere!';
//});

/*
// creates a route to show the task info when you click into a link
// show means show 1 tasks, index would be to show all
Route::get('/tasks/{id}', function ($id) use ($tasks) {
    //arrays aren't objects so you have to turn it into one with collection
    // firstwhere is used to find the first instance of the ID passed in the task
    $task = collect($tasks)->firstWhere('id', $id);

    //this is used if no tasks exists with this id
    if (!$task) {
        abort(Response::HTTP_NOT_FOUND);
    }

    //this returns the view of the task in the web page
    return view('show', ['task' => $task]);
    //this is how you know to use the show blade
})->name('tasks.show');

*/


