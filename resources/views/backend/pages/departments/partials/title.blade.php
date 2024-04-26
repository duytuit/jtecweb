@if (Route::is('admin.departments.index'))
Departments
@elseif(Route::is('admin.departments.create'))
Create New Department
@elseif(Route::is('admin.departments.edit'))
Edit Department {{ $department->title }}
@elseif(Route::is('admin.departments.show'))
View Department {{ $department->title }}
@endif
| Admin Panel -
{{ config('app.name') }}
