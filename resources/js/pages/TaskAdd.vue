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
                        <label>Task start date</label>
                        <date-picker v-model="task.startdate" type="datetime" format="YYYY-MM-DD HH:mm" valueType="format" :disabled-dates="disabledBefore"></date-picker>
                    </div>
                    <div class="form-group">
                        <label>Task end date</label>
                        <date-picker v-model="task.enddate" type="datetime" format="YYYY-MM-DD HH:mm"></date-picker>
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
   import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {

        components: {DatePicker},
        data() {
            return {
                disabledBefore: {
                    to: new Date(Date.now())
                } ,
                task: {status: "New"},
                users: {},
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