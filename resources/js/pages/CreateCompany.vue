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
                <form autocomplete="off" @submit.prevent="createOrganization">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" id="name" class="form-control" placeholder="Organization" v-model="organization.name">
                    </div>

                    <div class="form-group">
                        <label for="industry">Industry</label>
                        <select class="form-control" v-model="organization.industry">
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
                        <select class="form-control" v-model="organization.size">
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