<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeSalaryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin', [\App\Http\Controllers\DashboardController::class, 'dashboardAdmin'])->name('dashboard.admin');

    Route::resource('mbkm/about-app', \App\Http\Controllers\AboutAppController::class);

    Route::get('admin/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('profile/upload', [\App\Http\Controllers\ProfileController::class, 'upload'])->name('profile.upload');
    Route::delete('profile/delete-file', [\App\Http\Controllers\ProfileController::class, 'deleteFile'])->name('profile.deleteFile');
    Route::post('/temp/storage', [\App\Http\Controllers\StorageController::class, 'store'])->name('storage.store');
    Route::delete('/temp/storage', [\App\Http\Controllers\StorageController::class, 'destroy'])->name('storage.destroy');
    Route::get('/temp/storage/{path}', [\App\Http\Controllers\StorageController::class, 'show'])->name('storage.show');

    Route::resource('admin/role-permissions/permission', \App\Http\Controllers\RolePermission\PermissionController::class);
    Route::post('admin/role-permissions/permission/json', [\App\Http\Controllers\RolePermission\PermissionController::class, 'json'])->name('permission.json');

    Route::resource('admin/role-permissions/role', \App\Http\Controllers\RolePermission\RoleController::class);
    Route::post('admin/role-permissions/role/json', [\App\Http\Controllers\RolePermission\RoleController::class, 'json'])->name('role.json');

    Route::resource('admin/role-permissions/user', \App\Http\Controllers\UserController::class);
    Route::post('admin/role-permissions/user/json', [\App\Http\Controllers\UserController::class, 'json'])->name('user.json');

    Route::resource('admin/employee', EmployeeController::class);
    Route::post('admin/employee/json', [EmployeeController::class, 'json'])->name('employee.json');

    Route::resource('admin/position', \App\Http\Controllers\PositionController::class);
    Route::post('admin/position/json', [\App\Http\Controllers\PositionController::class, 'json'])->name('position.json');

    Route::resource('admin/work-days', \App\Http\Controllers\WorkDayController::class);
    Route::post('admin/work-days/json', [\App\Http\Controllers\WorkDayController::class, 'json'])->name('work-days.json');

    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');

    Route::get('salary/calculate/{employeeId}', [EmployeeSalaryController::class, 'calculateSalary'])->name('salary.calculate');
    Route::get('salary', [EmployeeSalaryController::class, 'index'])->name('salary.index');
});

require __DIR__ . '/auth.php';
