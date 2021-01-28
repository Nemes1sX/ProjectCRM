<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="card">
            <div class="card-header">
                {{ company.name}}
            </div>
            <div class="card-body">
                <h4>Company name: {{ company.name}}</h4>
                <p>CEO name: {{ company.ceoname}}</p>
                <p>Size: {{ company.size}}</p>
                 <p>Industry: {{ company.industry}}</p>
            </div>
        </div>
            <h4>Company projects</h4>
            <label class="form-control-label"  for="input-file-export">Export Excel File</label>
            <button type="button" class="btn btn-danger" id="input-file-export" @click="exportProjects(company.id, company.name)">Export CSV file</button>
                <input type="file" ref="file" class="form-control" id="file" :class="{ ' is-invalid' : error.message }" v-on:change="handleUpload()">
                <button type="submit" class="btn btn-success" v-on:click="importProjects()">Upload</button>
            <div v-if="error.message" class="invalid-feedback">
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="project in company.projects">
                    <td><router-link :to="{name: 'task.board', params: {id: project.id}}">{{project.name}}</router-link></td>
                    <td>{{project.description}}</td>
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
            company: {},
            file: '',
        }
    },
    created(){
        this.axios
            .get(`http://127.0.0.1:8000/api/company/show/${this.$route.params.id}`)
            .then(response =>{
                this.company = response.data.company;
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
        importProjects(){

          var formData = new FormData();
          formData.append('file', this.file);

          console.log(formData);

          this.axios
              .post('http://127.0.0.1:8000/api/project/import', formData, `${this.$route.params.id}`, {
                  headers: {
                      'Content-Type': 'multipart/form-data'
                  }
              })
              .then(() => {
                  windows.location.href = `company/show/${this.$route.params.id}`
              })
              .catch(error => {
                  console.log(error);
              })
              .finally(() => this.loading = false)
      },
      exportProjects(id, name){
          this.axios
              .get('http://127.0.0.1:8000/api/project/export', id, {
                  responseType: 'blob'
              })
              .then( response => {
                  var fileURL = window.URL.createObjectURL(new Blob([response.data]));

                 var fileLink = document.createElement('a');

                fileLink.href = fileURL;

                fileLink.setAttribute('download', name +'.csv');

                document.body.appendChild(fileLink);

                  fileLink.click();

              })
              .catch(error => {
                  console.log(error);
              })
              .finally(() => this.loading = false)
      },
      }
    }


</script>