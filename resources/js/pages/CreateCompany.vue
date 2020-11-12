<template>


    <div class="container">
        <div class="card card-default">
            <div class="card-header">Register Organization</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="validationErrors">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in validationErrors">{{ error }}</li>
                    </ul>
                </div>
                <form autocomplete="off" @submit.prevent="addCompany">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" id="name" class="form-control" placeholder="Organization" v-model="company.name">
                    </div>
                    <div class="form-group">
                        <label for="name">CEO Name</label>
                        <input type="name" id="ceoname" class="form-control" placeholder="CEO Name" v-model="company.ceoname">
                    </div>
                    <div class="form-group">
                        <label for="industry">Industry</label>
                        <select class="form-control" v-model="company.industry">
                            <option  value="">-</option>
                            <option  value="Drinks">Drinks</option>
                            <option  value="Food">Food</option>
                            <option  value="Electronics">Electronics</option>
                            <option  value="Farming">Farming</option>
                            <option  value="Chemistry">Chemistry</option>
                            <option  value="Marine industry">Marine industry</option>
                        </select>
                    </div>

                    <div class="form-group" >
                        <label for="size">Size</label>
                        <select class="form-control" v-model="company.size">
                            <option  value="">-</option>
                            <option  value="10">10</option>
                            <option  value="10-50">10-50</option>
                            <option  value="50-100">50-100</option>
                            <option  value="100-500">100-500</option>
                            <option  value="500-1000">500-1000</option>
                            <option  value=">1000">>1000+</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full btn btn-default btn-primary items-center hover:bg-primary-dar form-group">Create Company</button>

                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default{
        components: { DatePicker },
        data() {
            return {
                company: {},
                validationErrors: '',
            }
        },
        computed:{
            validationErrors(){
                let errors = Object.values(this.errors)
                errors = errors.flat()
                return errors;
            }
        },
        methods: {
            addCompany(){
                this.validationErrors = [];
                this.axios
                    .post('http://127.0.0.1:8000/api/company/create', this.company)
                    .then( () =>{
                       this.$router.push({name: 'company'})
                    })
                    .catch(error => {
                        this.validationErrors = error.response.data.errors
                    })
                    .finally(() => this.loading = false)
            }
        },
    }


</script>