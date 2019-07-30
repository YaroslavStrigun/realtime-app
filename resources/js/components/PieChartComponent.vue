<template>
    <pie-chart :chart-data="data" :height="100" :options="{responsive: true, maintainAspectRation: true}"></pie-chart>
</template>

<script>
    import PieChart from './PieChart.js';

    export default {
        components: {
            PieChart
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
                axios.get('/data-chart').then((response) => {
                    this.data = response.data;
                });
            }
        }
    }
</script>
