<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="row">
                <router-link :to="{name: 'project.create'}" active-class="active" class="btn btn-success">Create Project</router-link>
                <table class="table table-bordered">
                    <thead>
                    <tr>
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
                            <a href="#" @click.prevent="change_sort('company')">Company</a>
                            <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'asc'">&#8593;</span>
                            <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'desc'">&#8595;</span>
                        </th>
                        <th>
                            <a href="#" @click.prevent="change_sort('status')">Status</a>
                            <span v-if="this.params.sort_field == 'status' && this.params.sort_direction == 'asc'">&#8593;</span>
                            <span v-if="this.params.sort_field == 'status' && this.params.sort_direction == 'desc'">&#8595;</span>
                        </th>
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="project in projects">
                        <td><router-link :to="{name: 'task.board', params: {id: project.id}}">{{project.name}}</router-link></td>
                        <td>{{project.description}}</td>
                        <td>{{project.company.name}}</td>
                        <td>{{project.status}}</td>
                        <td>{{project.startdate}}</td>
                        <td>{{project.enddate}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <router-link :to="{name: 'project.edit', params: { id: project.id }}" class="btn btn-primary">Edit
                                </router-link>
                                <button class="btn btn-danger" @click="deleteProject(project.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import Sidebar from "../../components/Sidebar";

    export default{
        components: {
            'sidebar': Sidebar
        },
        data(){
            return{
                projects: {},
                params: {
                    sort_field: 'name',
                    sort_direction: 'desc',
                },
            }
        },
        mounted(){
            this.getProjects()
        },
        watch:{
            params: {
                handler(){
                    this.getProjects();
                },
                deep: true
            },
        },
        methods:{
            getProjects(){
                this.axios
                    .get('http://127.0.0.1:8000/api/project/index', {
                        params: { ...this.params }
                    })
                    .then( response => {
                        this.projects = response.data.projects;
                        this.$router.push({name: 'projects' });
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => this.loading = false)
            },
            deleteProject(id){
                this.axios
                    .delete(`http://127.0.0.1:8000/api/project/delete/${id}`)
                    .then()
                    .catch(error => {
                        console.log(error)
                    })
            .finally(() => this.loading = false)
            },
            change_sort(field){
                if(this.params.sort_field === field){
                    this.params.sort_direction = this.params.sort_direction === 'asc' ? 'desc' : 'asc';
                }
                else{
                    this.params.sort_field = field;
                    this.params.sort_direction = 'asc';
                }
            },
        }
    }
</script>