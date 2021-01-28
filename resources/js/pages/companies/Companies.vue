s<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="row">
                <router-link :to="{name: 'company.create'}" active-class="active" class="btn btn-info">Add Company</router-link>
                <button type="button" class="btn btn-success" @click="exportCompanies">Export Excel file</button>
                    <label class="form-control-label"  for="file">Upload Excel File</label>
                    <input type="file" ref="file" id="file" class="form-control" :class="{ ' is-invalid' : error.message }"  v-on:change="onFileChange()">
                    <button type="submit" class="btn btn-success" v-on:click="importCompanies()">Upload</button>
                <div v-if="error.message" class="invalid-feedback">
                </div>
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
            handleUpload(){
                this.file = this.$refs.file.files[0];
            },
            importCompanies(){

                var formData = new FormData();
                formData.append('file', this.file);
                this.axios
                    .post('http://127.0.0.1:8000/api/company/import',{file: formData}, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                    .then(() => {
                        windows.location.href = `company`
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