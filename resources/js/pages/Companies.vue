<script src="../app.js"></script>
<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="row">
                <router-link :to="{name: 'company.create'}" active-class="active" class="btn btn-success">Add Company</router-link>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CEO Name</th>
                            <th>Industry</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="company in companies">
                            <td>{{company.name}}</td>
                            <td>{{company.ceoname}}</td>
                            <td>{{company.industry}}</td>
                            <td>{{company.size}}</td>
                            <td>
                                <router-link :to="{name: 'company.edit', params: { id: company.id }}" class="btn btn-primary">Edit
                                </router-link>
                                <button class="btn btn-danger" @click="deleteCompany(company.id)">Delete</button>
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
                companies: {},
            }
        },
        created(){
            this.axios
                .get('http://127.0.0.1:8000/api/company/index')
                .then( response => {
                   this.companies = response.data.companies;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => this.loading = false)
        },
        methods:{
            deleteCompany(id){
                this.axios
                    .delete(`http://127.0.0.1:8000/api/company/delete/${id}`)
                    .then()
                    .catch(error => {
                        console.log(error)
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>