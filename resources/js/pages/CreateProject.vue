<template>


    <div class="container">
        <div class="card card-default">
            <div class="card-header">Create Project</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="validationErrors">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in validationErrors">{{ error }}</li>
                    </ul>
                </div>
                <form autocomplete="off" @submit.prevent="addProject">
                    <div class="form-group">
                        <label>Assigned Company</label>
                        <select class="form-control" v-model="project.company_id">
                            <option v-for="company in companies"  v-bind:value="company.id">{{ company.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" id="name" class="form-control" placeholder="Project Name" v-model="project.name">
                    </div>
                    <div class="form-group">
                        <label for="industry">Description</label>
                        <textarea class="form-control" cols="10" rows="15" placeholder="Description" v-model="project.description"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="task-start-date">Project Start Date</label>
                        <date-picker v-model="project.startdate" type="date" format="YYYY-MM-DD"></date-picker>
                    </div>
                    <div class="form-group" >
                        <label for="task-end-date">Project End Date</label>
                        <date-picker v-model="project.enddate" type="date" format="YYYY-MM-DD"></date-picker>
                    </div>
                    <button type="submit" class="btn btn-success form-group">Add Projecty</button>

                </form>

                <router-link active-class="btn btn-danger form-control" exact :to="{name: 'projects'}"> Back to Project list</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {
    components: { DatePicker },
    data() {
        return {
            project: {},
            companies: {},
            validationErrors: '',
        }
    },
    mounted(){
        this.getCompanies();
    },
        computed:{
            validationErrors(){
                let errors = Object.values(this.errors)
                errors = errors.flat()
                return errors;
            }
        },
    methods:{
        addProject(){
            this.axios
                .post('http://127.0.0.1:8000/api/project/create', this.project)
                .then( () =>{
                    this.$router.push({name : 'project'})
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => this.loading = false)
        },
        getCompanies(){
            this.axios
                .get('http://127.0.0.1:8000/api/company/index')
                .then(response =>{
                   this.companies = response.data.companies;
                })
                .catch(error => {
                this.validationErrors = error.response.data.errors;
            })
                .finally(() => this.loading = false)
        }
    }
    }

</script>