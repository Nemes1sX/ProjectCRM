
<template>
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <section class="list">
                <header>UPCOMING</header>
                <draggable class="drag-area" draggable=".item" :options="{animation:200, group:'status'}" v-model="tasksNotCompleted" :element="'article'" @add="onAdd($event, false)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksNotCompleted" :key="task.id" :data-id="task.id">
                        <header>
                            {{ task.name }}
                        </header>
                    </article>
                </draggable>
            </section>
        </div>
        <div class="col-md-4">
            <section class="list">
                <header>COMPLETED</header>
                <draggable class="drag-area" draggable=".item" :options="{animation:200, group:'status'}" :element="'article'" v-model="tasksCompleted" @add="onAdd($event, true)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksCompleted" :key="tasksCompleted.id" :data-id="tasksCompleted.id">
                        <header>
                            {{ task.name }}
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
               tasksNotCompleted: [],
               tasksCompleted: []
            }
        },
        methods: {
            created(){
                this.axios
                    .get(`http://127.0.0.1:8000/api/project/taskboard/${this.$route.params.id}`)
                    .then( response => {
                        this.tasksNotCompleted = response.data.tasksNotCompleted;
                        this.tasksCompleted = response.data.tasksCompleted;
                        console.log(response.data.status);
                        console.log(this.tasksCompleted);
                        console.log(this.tasksNotCompleted);
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => this.loading = false)
            },
            onAdd(event, status) {
                let id = event.item.getAttribute('data-id');
                axios.patch('/task/updatestatus' + id, {
                    status: status
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })
            },
            update() {
                this.tasksNotCompletedNew.map((task, index) => {
                    task.order = index + 1;
                });

                this.tasksCompletedNew.map((task, index) => {
                    task.order = index + 1;
                });

                let tasks = this.tasksNotCompletedNew.concat(this.tasksCompletedNew);

                axios.put('/task/updateAll', {
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