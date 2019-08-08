<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">
                    <div class="col-sm-4">
                        <select multiple="" class="form-control" v-model="usersSelect">
                            <option v-for="user in users" :value="'news-action.' + user.id">{{ user.email}}</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <textarea rows="6" readonly="" class="form-control">{{ dataMessages.join('\n')}}</textarea>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Send message" v-model="message">
                    <div class="input-group-append">
                        <button @click="sendMessage" type="button" class="btn btn-outline-secondary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                dataMessages: [],
                message: ""
            }
        },
        props: [
            'users',
            'user'
        ],
        mounted() {
            var socket = io('http://realtime:3000');
            socket.on("news-action." + this.user.id +":App\\Events\\PrivateMessage", function (data) {
                this.dataMessages.push(data.message.user + ': ' + data.message.message);
            }.bind(this));
            socket.on("news-action.:App\\Events\\PrivateMessage", function (data) {
                this.dataMessages.push(data.message.user + ': ' +  data.message.message);
            }.bind(this));
        },
        methods: {
            sendMessage: function () {
                if(!this.usersSelect.length) {
                    this.usersSelect.push('news-action.*');
                }
                axios({
                    method: 'get',
                    url: '/send-private-message',
                    params: {
                        message: this.message,
                        channels: this.usersSelect,
                        user: this.user.email
                    }
                }).then((response) => {
                    this.dataMessages.push(this.user.email + ': ' + this.message);
                    this.message = "";
                });
            }
        }
    }
</script>
