
<template>
    <div class="container">
        <full-calendar :event-sources="eventSources"header="{
                    left: 'prev, next today',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay, listWeek',
                }"></full-calendar>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                eventSources: [{
                        events(start, end, timezone, callback){
                            axios.get('http://127.0.0.1:8000/api/project/index')
                                .then(response =>{
                                    callback(response.data.projects)
                                    console.log(response.data.projects)
                                })
                        },
                        color: 'green',
                        textColor: 'black',
                    }]
            }
        }
    }
</script>