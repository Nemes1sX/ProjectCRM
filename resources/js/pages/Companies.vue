<template>
    <div class="row">
        <sidebar></sidebar>
        <div class="col-lg-9 mt-4">
            <div class="row">
                <h1>Hello Companies</h1>
                <router-link active-class="active"></router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import Sidebar from "../components/Sidebar";

    export default{
        components: {
            'sidebar': Sidebar
        }
    }
</script>