<template>
    <ProfileFriendsList :friends="friends" type="pending"></ProfileFriendsList>
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
        axios.get('/api/profile/friends?type=pending').then((resp) => {
            self.friends = resp.data
        })
    },
}
</script>

<style scoped>

</style>
