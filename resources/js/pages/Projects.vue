<script src="../routes/index.js"></script>
<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="row">
                <router-link :to="{name: 'project.create'}" active-class="active" class="btn btn-success">Create Project</router-link>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="project in projects">
                        <td>{{project.name}}</td>
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
    import Sidebar from "../components/Sidebar";

    export default{
        components: {
            'sidebar': Sidebar
        },
        data(){
            return{
                projects: {}
            }
        },
        created(){
            this.axios
                .get('http://127.0.0.1:8000/api/project/index')
                .then( response => {
                    this.projects = response.data.projects;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => this.loading = false)
        },
        methods:{
            deleteProject(id){
                this.axios
                    .delete(`http://127.0.0.1:8000/api/project/delete/${id}`)
                    .then()
                    .catch(error => {
                        console.log(error)
                    })
            .finally(() => this.loading = false)
            }
        }
    }
</script>