<template>
    <div class="container">
    <line-chart :chart-data="data" :height="100" :options="{responsive: true, maintainAspectRation: true}"></line-chart>
    <button @click="update" class="btn btn-primary btn-xs text mt-1 mh-10">Update</button>
    </div>
</template>

<script>
    import LineChart from './LineChart.js';

    export default {
        components: {
            LineChart
        },
        data: function () {
            return {
                data: [],
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            update: function () {
                axios.get('/random-chart').then((response) => {
                    this.data = response.data;
                });
            }
        }
    }
</script>
