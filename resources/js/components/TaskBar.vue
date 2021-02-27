<script>
    import {  Bar } from 'vue-chartjs';

    export default {
        extends: Bar,
        mounted() {
            let Roles = ['Software Engineer', 'IT Engineer', 'Manager'];
            this.axios
                .get('http://localhost:8000/api/gettask')
                .then(response => {
                      var taskSE = response.data.tasksSoftwareEngineer;
                      var taskIE = response.data.tasksItEngineer;
                      var taskTM = response.data.tasksManager;
                        this.renderChart({
                            labels: Roles,
                            datasets: [{
                                label: 'Roles per task',
                                backgroundColor: '#FC2525',
                                data: [taskSE, taskIE, taskTM]
                            }],
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            min: 0,
                                            max: 100,
                                            stepSize: 3,
                                        }
                                    }]
                                }
                            }
                        });


                    });
                }
        }
</script>