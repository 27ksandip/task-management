
# Task Management

This is task management application which as bellow features 


### Create a very simple Laravel web application for task management:
#### Create task (info to save: task name, priority, timestamps)
#### Edit task
#### Delete task
#### Reorder tasks with drag and drop in the browser.
Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.
Tasks should be saved to a mysql table.
#### BONUS POINT:
add project functionality to the tasks. User should be able to select a project from a dropdown and only view tasks associated with that project.

## All Above point has been included in this project. 
### What i did:
## TaskController
Which handle all task related action like add, edit, delete & also shorting
## Model 
Created two model Project & Task to handle all above features . In Task model has belongsTo relation to show project on task . Also on project model hasMany relation to create tasks each project. 
## Migration
Migration file to create project & task table
## Factory & Seeder
To create default project & task i have used Factory & seeder where i have created 10 project & 20 tasks each project 
## Frontend 
I have used bootstrap-4 to make all above features also jQuery Sortab
## Priority & Shorting 
To handle this i have used jQuery Sortable 




## Deployment

### Step Project
##### 1. git clone https://github.com/27ksandip/task-management.git
##### 2. php artisan serve
##### 3. update .env set database name , user & if has passwor
##### 4. php artisan migrate:fresh --seed

## Authors

- Sandip Jha
