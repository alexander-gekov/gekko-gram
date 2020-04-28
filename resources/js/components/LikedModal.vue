<template>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Liked by:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-for="user in this.users" :key="user.id" class="row">
                        <div class="col-8 offset-2">
                            <div>
                                <div
                                    class="d-flex align-items-center justify-content-between p-2 bg-white">
                                    <div class="d-flex">
                                        <div class="pr-3">
                                            <img :src="/storage/ + user.profile.image"
                                                 style="max-width: 30px;"
                                                 class="w-100 rounded-circle">
                                        </div>
                                        <div class="font-weight-bold">
                                            <a class="text-dark"
                                               :href="/profile/ + user.id">{{user.username}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/p/' + this.postid + '/liked')
                .then(response => {
                    this.users = response.data.users;
                    console.log(this.users);
                })
        },

        computed: {
            filteredUsers() {

            }
        },
        props: ['postid'],
        data: function () {
            return {
                users: [],
            }
        },

        methods: {
            reload: function () {
                axios.get('/p/' + this.postid + '/liked')
                    .then(response => {
                        this.users = response.data.users;
                        //console.log(this.users);
                    })
            }
        }
    }
</script>
