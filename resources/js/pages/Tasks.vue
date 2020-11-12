<template>
    <div>
        <h3 class="text-center">All Tasks</h3><br/>
        <form @submit.prevent="taskSort">
            <select class="form-control" v-model="sortcolumn">
                <option value="taskdate">Date</option>
                <option value="status">Status</option>
            </select>
            <select class="form-control" v-model="ascdsc">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
            <button type="submit" class="btn btn-primary">Sort Tasks</button>
        </form>
      
        <router-link :to="{name: 'task.create'}" class="btn btn-success">Add Task</router-link>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Taskdate</th>
                <th>Status</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

              <tr v-for="task in tasks" :key="task.id">
                  <td>{{ task.name }}</td>
                  <td>{{ task.description }}</td>
                  <td>{{ task.project.name }}</td>
                  <td>{{ task.startdate }}</td>
                  <td>{{ task.enddate }}</td>
                  <td>{{ task.status }}</td>
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
               
            }
        },
        created() { //Fetch tasks
            this.axios
                .get('http://127.0.0.1:8000/api/tasks')
                .then(response => {
                    this.tasks = response.data.tasks;
                });

        },
        methods: { //Delete tasks
           /* deleteTask(id) {
                this.axios
                    .delete(`http://127.0.0.1:8000/api/task/delete/${id}`)
                    .then(response => {
                        let i = this.tasks.map(item => item.id).indexOf(id); // find index of your object
                        this.tasks.splice(i, 1)
                    });
            },
            taskSort(sortcolumn, ascdsdc){ //Sorting
                this.axios
                    .get(`http://127.0.0.1:8000/api/task/tasksort/${sortcolumn}/${ascdsc}`)
                          .then(response => {
                            this.tasks = response.data.tasks;
                    });
                    }
            }*/
            deleteTask(id) {
                this.axios
                    .delete(`http://127.0.0.1:8000/api/task/delete/${id}`)
                    .then()
                    .catch(error => {
                        console.log(error)
                    })
                    .finally(() => this.loading = false)
            }

            },
        }

    
</script>