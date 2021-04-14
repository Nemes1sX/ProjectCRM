<template>
    <div class="row">

        <sidebar></sidebar>

        <div class="col-lg-9 mt-4">
            <div class="row">
                <div class="card bg-secondary text-white col-md-3">
                    <div class="card-body">Backlog tasks: {{tasksToDo}}</div>
                </div>
                <div class="card bg-danger text-white col-md-3">
                    <div class="card-body">To-do tasks: {{tasksToDo}}</div>
                </div>
                <div class="card bg-primary text-white col-md-3">
                    <div class="card-body">In progress tasks: {{tasksInProgress}}</div>
                </div>
                <div class="card bg-success text-white col-md-3">
                    <div class="card-body">Completed tasks: {{tasksCompleted}}</div>
                </div>
            </div>
        </div>
        <div class="taskbar">
            <taskbar></taskbar>
        </div>
    </div>
    <!-- /.row -->

</template>

<style>
    .taskbar{
        margin: 0 auto;
    }
</style>

<script>
    import Sidebar from "../components/Sidebar";
    import TaskBar from "../components/TaskBar";

    export default {
        data() {
            return {
                tasksBacklog: '',
                tasksToDo: '',
                tasksInProgress: '',
                tasksCompleted: ''
            }
        },
        created(){
          this.axios
              .get('http://localhost:8000/api/home')
              .then( response => {
                  this.tasksBacklog = response.data.tasksBacklog;
                  this.tasksToDo = response.data.tasksToDo;
                  this.tasksInProgress = response.data.tasksInProgress;
                  this.tasksCompleted = response.data.tasksCompleted;
              })
        },
        mounted() {

        },
        components: {
            'sidebar': Sidebar,
            'taskbar': TaskBar
        }
    }
</script>
