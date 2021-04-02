
<template>
    <div class="row">
        <div class="col-md-3 col-md-offset-2">
            <section class="list">
                <header>TO DO</header>
                <draggable class="drag-area"  v-bind="{animation:200, group:'status'}" v-model="tasksNotCompleted" :tag="'article'" @add="onAdd($event, false)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksToDo" :key="tasksToDo.id" :data-id="task.id">
                        <header>
                            {{ task.name }}
                        </header>
                    </article>
                </draggable>
            </section>
        </div>
        <div class="col-md-3 col-md-offset-2">
            <section class="list">
                <header>TO DO</header>
                <draggable class="drag-area"  v-bind="{animation:200, group:'status'}" v-model="tasksNotCompleted" :tag="'article'" @add="onAdd($event, false)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksToDo" :key="tasksToDo.id" :data-id="task.id">
                        <header>
                            {{ "T"+task.id}}
                            {{ task.name }}
                             <br>
                            {{ task.user.name }}
                            {{ [task.user.role]}}
                        </header>
                    </article>
                </draggable>
            </section>
        </div>
        <div class="col-md-3">
            <section class="list">
                <header>IN PROGRESS</header>
                <draggable class="drag-area"  v-bind="{animation:200, group:'status'}" :tag="'article'" v-model="tasksInProgress" @add="onAdd($event, true)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksInProgress" :key="tasksInProgress.id" :data-id="task.id">
                        <header>
                            {{ "T"+task.id}}
                            {{ task.name }}
                            <br>
                            {{ task.user.name }}
                            {{ [task.user.role] }}
                        </header>
                    </article>
                </draggable>
            </section>
        </div>
        <div class="col-md-3">
            <section class="list">
                <header>COMPLETED</header>
                <draggable class="drag-area"  v-bind="{animation:200, group:'status'}" :tag="'article'" v-model="tasksCompleted" @add="onAdd($event, true)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksCompleted" :key="tasksCompleted.id" :data-id="task.id">
                        <header>
                            {{ "T"+task.id}}
                            {{ task.name }}
                            <br>
                            {{ task.user.name }}
                            {{ [task.user.role] }}
                        </header>
                    </article>
                </draggable>
            </section>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },
        data() {
            return {
                tasksBacklog: {},
                tasksToDo: {},
                tasksInProgress: {},
                tasksCompleted: {}
            }
        },
        created(){
            this.axios
                .get(`http://127.0.0.1:8000/api/project/taskboard/${this.$route.params.id}`)
                .then( response => {
                    this.tasksBacklog = response.data.tasksBacklog;
                    this.tasksToDo =  response.data.tasksToDo;
                    this.tasksInProgress =  response.data.tasksInProgress;
                    this.tasksCompleted = response.data.tasksCompleted;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => this.loading = false)
        },
        methods: {
            onAdd(event, status) {
                let id = event.item.getAttribute('data-id');
                axios.patch('http://127.0.0.1:8000/api/task/updatestatus/' + id, {
                    status: status
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })
            },
            update() {
                this.tasksBacklog.map((task, index) => {
                   task.order = index + 1;
                });
                this.tasksToDo.map((task, index) => {
                    task.order = index + 1;
                });

                this.tasksInProgress.map((task, index) => {
                   task.order = index + 1;
                });

                this.tasksCompleted.map((task, index) => {
                    task.order = index + 1;
                });

                let tasks = this.tasksToDo.concat(this.tasksBacklog, this.tasksToDo, this.tasksInProgress,
                    this.tasksCompleted);

                this.axios.put('http://127.0.0.1:8000/api/task/updateAll', {
                    tasks: tasks
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })
            }

        }
    }
</script>

<style>
    .list {
        background-color: #26004d;
        border-radius: 3px;
        margin: 5px 5px;
        padding: 10px;
        width: 100%;
    }
    .list>header {
        font-weight: bold;
        color: white;
        text-align: center;
        font-size: 20px;
        line-height: 28px;
        cursor: grab;
    }
    .list article {
        border-radius: 3px;
        margin-top: 10px;
    }

    .list .card {
        background-color: #FFF;
        border-bottom: 1px solid #CCC;
        padding: 15px 10px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bolder;
    }
    .list .card:hover {
        background-color: #F0F0F0;
    }
    .drag-area{
        min-height: 10px;
    }
</style>