<template>
    <div>
        <h3 class="text-center">Add Task</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addTask">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="task.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" v-model="task.description"></textarea>
                    </div>
                     <div class="form-group">
                        <label for="task-start-date">Task start date</label>
                        <b-form-datepicker id="task-start-date" v-model="task.startdate" type="date" format="YYYY-MM-DD" valueType="format" :disabled-dates="disabledBefore"></b-form-datepicker>
                    </div>
                    <div class="form-group">
                        <label for="task-end-date">Task end date</label>
                        <b-form-datepicker id="task-end-date" v-model="task.enddate" type="date" format="YYYY-MM-DD" valueType="format" :disabled-dates="disabledBefore"></b-form-datepicker>
                    </div>
                    <div class="form-group">
                        <label>Assigned project</label>
                        <select class="form-control" v-model="task.project_id">
                            <option v-for="project in projects"  v-bind:value="project.id">{{ project.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                disabledBefore: {
                    to: new Date(Date.now())
                } ,
                projects: {}
            }
        },
        mounted(){
            this.getUsers()
        },
        methods: {
            addTask() {
                console.log(this.task)
                this.axios
                    .post('http://localhost:8000/api/task/create', this.task)
                    .then(() => {
                        this.$router.push({name: 'home'})
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            getUsers(){ //Fetch users for assigning them
                this.axios
                    .get('http://127.0.0.1:8000/api/project/index')
                    .then(response => {
                        this.projects = response.data.projects;
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
        }
    }
</script>