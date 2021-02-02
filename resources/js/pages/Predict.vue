<template>
    <div class="row">
        <form @submit.prevent="predictTask">
            <label for="taskdesc">Task classification</label>
            <input type="text" class="form-control" id="taskdesc" v-model="taskname">
            <button type="submit" class="btn btn-success btn-block mt-3">Predict</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                taskname : '',
            }
        },
        methods: {
            predictTask(){
                this.axios
                    .post('http://localhost:5000/results', {title: this.taskname})
                    .then(response => {
                        role = response.data.role;
                        console.log(role);
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>