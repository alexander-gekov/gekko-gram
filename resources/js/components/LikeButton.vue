<template>
    <div>
        <div>
            <button class="btn btn-primary" @click="toggleLike"
                    v-text="buttonText"></button>
        </div>
        <div class="bg-white">
            <span>Liked by</span>
            <span class="font-weight-bold" v-text="likedCount"></span>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/p/' + this.post + '/count')
                .then(response => {
                    this.likedCount = response.data[0].count
                });
            axios.get('/p/' + this.post + '/reacted')
                .then(response => {
                    if(response.data == 1){
                        this.liked = true;
                    }
                    else{
                        this.liked = false;
                    }
                });
        },

        computed: {
            buttonText() {
                return (this.liked) ? 'Unlike' : 'Like';
            }
        },
        props: ['post'],
        data: function () {
            return {
                liked: false,
                likedCount: '0',
                likedBy: [],
            }
        },

        methods: {
            toggleLike: function () {
                if (this.liked) {
                    this.unlikePhoto()
                } else {
                    this.likePhoto()
                }
            },
            likePhoto: function () {
                axios.post('/p/' + this.post + '/like')
                    .then(response => {
                        this.liked = true;
                        this.likedCount = response.data[0].count;
                    })
            },
            unlikePhoto: function () {
                this.liked = false;
                axios.post('/p/' + this.post + '/unlike')
                    .then(response => {
                        this.liked = false;
                        this.likedCount = response.data[0].count;
                    })
            }
        }
    }
</script>
