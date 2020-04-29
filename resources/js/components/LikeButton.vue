<template>
    <div>
        <div>
            <button class="btn peach-gradient" @click.prevent="toggleLike"
                    v-text="buttonText"></button>
        </div>
        <div class="bg-white px-2">
            <span>Liked by</span>
            <span class="font-weight-bold"><a href="#" @click="reload" data-toggle="modal" data-target="#likedByModal" class="text-dark">{{likedCount}}</a></span>
            <liked-modal ref="likedModal" id="likedByModal" :postid="this.post"></liked-modal>
        </div>
    </div>
</template>

<script>
    import LikedModal from "./LikedModal";

    export default {
        mounted() {
            axios.get('/p/' + this.post + '/count')
                .then(response => {
                    this.likedCount = response.data[0].count;
                    console.log(response.data[0]);
                });
            axios.get('/p/' + this.post + '/reacted')
                .then(response => {
                    if(response.data){
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
            },
            reload: function(){
                this.$refs.likedModal.reload();
            }
        }
    }
</script>
