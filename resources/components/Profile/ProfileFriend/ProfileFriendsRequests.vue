<template>
    <ProfileFriendsList :friends="friends" type="requests"></ProfileFriendsList>
</template>

<script>
import ProfileFriendsList from "./ProfileFriendsList.vue";

export default {
    components: {ProfileFriendsList},

    data(){
        return{
            friends: []
        }
    },

    mounted() {
        let self = this
        axios.get('/api/profile/friends?type=requests').then((resp) => {
            self.friends = resp.data
        })
    },
}
</script>

<style scoped>

</style>
