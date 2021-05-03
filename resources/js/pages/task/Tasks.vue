<template>
    <div>
        <h3 class="text-center">All Tasks</h3><br/>
        <router-link :to="{name: 'task.create'}" class="btn btn-success">Add Task</router-link>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    <a href="#" @click.prevent="change_sort('id')">ID</a>
                    <span v-if="this.params.sort_field == 'id' && this.params.sort_direction == 'asc'">&#8593;</span>
                    <span v-if="this.params.sort_field == 'id' && this.params.sort_direction == 'desc'">&#8595;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('name')">Name</a>
                    <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'asc'">&#8593;</span>
                    <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'desc'">&#8595;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('description')">Description</a>
                    <span v-if="this.params.sort_field == 'description' && this.params.sort_direction == 'asc'">&#8593;</span>
                    <span v-if="this.params.sort_field == 'description' && this.params.sort_direction == 'desc'">&#8595;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('status')">Status</a>
                    <span v-if="this.params.sort_field == 'status' && this.params.sort_direction == 'asc'">&#8593;</span>
                    <span v-if="this.params.sort_field == 'status' && this.params.sort_direction == 'desc'">&#8595;</span>
                </th>
                <th>Project</th>
                <th>Assigned user</th>
                <th>User role</th>
                <th>
                    <a href="#" @click.prevent="change_sort('startdate')">Start Date</a>
                    <span v-if="this.params.sort_field == 'startdate' && this.params.sort_direction == 'asc'">&#8593;</span>
                    <span v-if="this.params.sort_field == 'startdate' && this.params.sort_direction == 'desc'">&#8595;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('enddate')">End Date</a>
                    <span v-if="this.params.sort_field == 'enddate' && this.params.sort_direction == 'asc'">&#8593;</span>
                    <span v-if="this.params.sort_field == 'enddate' && this.params.sort_direction == 'desc'">&#8595;</span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

              <tr v-for="task in tasks" :key="task.id">
                  <td>{{ "T"+task.id }}</td>
                  <td>{{ task.name }}</td>
                  <td>{{ task.description }}</td>
                  <td v-if="task.status === 0">Backlog</td>
                  <td v-else-if="task.status === 1">To-do</td>
                  <td v-else-if="task.status === 2">In progress</td>
                  <td v-else-if="task.status === 3">Completed</td>
                  <td v-else>Undefined</td>
                  <td>{{ task.estimated_time}}</td>
                  <td>{{ task.project.name }}</td>
                  <td>{{ task.user.name }}</td>
                  <td>{{ task.user.role}}</td>
                  <td>{{ task.startdate }}</td>
                  <td>{{ task.enddate }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'task.edit', params: { id: task.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                params: {
                    sort_field: 'name',
                    sort_direction: 'desc'
                }

            }
        },
        mounted(){
            this.getTasks()
        },
        watch:{
            params: {
                handler(){
                    this.getTasks();
                },
                deep: true
            },
        },
        methods: {
            getTasks() { //Fetch tasks
                this.axios
                    .get('http://127.0.0.1:8000/api/task/index', {
                    params: {...this.params}
                    })
                    .then(response => {
                        this.tasks = response.data.tasks;
                    });

            },
            deleteTask(id) {
                this.axios
                    .delete(`http://127.0.0.1:8000/api/task/delete/${id}`)
                    .then()
                    .catch(error => {
                        console.log(error)
                    })
                    .finally(() => this.loading = false)
            },
            change_sort(field){
                if (this.params.sort_field === field) {
                    this.params.sort_direction = this.params.sort_direction === 'asc' ? 'desc' : 'asc';
                }
                else {
                    this.params.sort_field = field;
                    this.params.sort_direction = 'asc';
                }
            },
        }
    }
    
</script>