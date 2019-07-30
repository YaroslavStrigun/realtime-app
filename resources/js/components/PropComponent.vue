<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="url in urldata">
                        <td>{{ url.title }}</td>
                        <td>{{ url.url }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // Входные параметры
        props: [
          'urldata'
        ],
        mounted() {
            console.log('Component mounted.')
            this.update()
        },
        methods: {
            update: function () {
                console.log(this.urldata)
            }
        }
    }
</script>
