s<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="row">
                <router-link :to="{name: 'company.create'}" active-class="active" class="btn btn-info">Add Company</router-link>
                <button type="button" class="btn btn-success" @click="exportCompanies">Export Excel file</button>
                    <label class="form-control-label"  for="file">Upload Excel File</label>
                    <input type="file" ref="file" id="file" class="form-control" :class="{ ' is-invalid' : error.message }"  @change="handleUpload()">
                    <button type="submit" class="btn btn-success" v-on:click="importCompanies()">Upload</button>
                <div v-if="error.message" class="invalid-feedback">
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <a href="#" @click.prevent="change_sort('name')">Name</a>
                                <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'asc'">&#8593;</span>
                                <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'desc'">&#8595;</span>
                            </th>
                            <th>
                                <a href="#" @click.prevent="change_sort('ceoname')">CEO Name</a>
                                <span v-if="this.params.sort_field == 'ceoname' && this.params.sort_direction == 'asc'">&#8593;</span>
                                <span v-if="this.params.sort_field == 'ceoname' && this.params.sort_direction == 'desc'">&#8595;</span>
                            </th>
                            <th>
                                <a href="#" @click.prevent="change_sort('industry')">Industry</a>
                                <span v-if="this.params.sort_field == 'industry' && this.params.sort_direction == 'asc'">&#8593;</span>
                                <span v-if="this.params.sort_field == 'industry' && this.params.sort_direction == 'desc'">&#8595;</span>
                            </th>
                            <th>
                                <a href="#" @click.prevent="change_sort('size')">Size</a>
                                <span v-if="this.params.sort_field == 'size' && this.params.sort_direction == 'asc'">&#8593;</span>
                                <span v-if="this.params.sort_field == 'size' && this.params.sort_direction == 'desc'">&#8595;</span>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="company in companies">
                            <td><router-link :to="{name: 'company.show', params: {id: company.id} }">{{company.name}}</router-link></td>
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
    import Sidebar from "../../components/Sidebar";

    export default{
        components: {
            'sidebar': Sidebar
        },
        data(){
            return{
                error: {},
                companies: {},
                file: '',
                params: {
                    sort_field: 'name',
                    sort_direction: 'desc',
                }
            }
        },
        mounted(){
            this.getCompanies()
        },
        watch:{
           params: {
               handler(){
                   this.getCompanies();
               },
               deep: true
           },
        },
        methods:{
            handleUpload(){
                this.file = this.$refs.file.files[0];
                console.log(this.file)
            },
            importCompanies(){

                let formData = new FormData();
                formData.append('file', this.file);

                this.axios
                    .post('http://127.0.0.1:8000/api/company/import', formData, {
                    headers: { 'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2) }
                })
                    .then(() => {
                        this.$router.push('company')
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => this.loading = false)
            },
            exportCompanies(){
                this.axios
                    .get('http://127.0.0.1:8000/api/company/export', {
                        responseType: 'blob'
                    })
                    .then(response => {
                        const url = window.URL.createObjectURL(new Blob([response.data]))
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', 'companies.xlsx'); //or any other extension
                        document.body.appendChild(link);
                        link.click();
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => this.loading = false)
            },
            getCompanies(){
                axios
                    .get('http://127.0.0.1:8000/api/company/index', {
                        params: {
                            ...this.params
                        }
                    })
                    .then( response => {
                        this.companies = response.data.companies;
                    })
                    .catch(error => {
                        console.log(error);
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