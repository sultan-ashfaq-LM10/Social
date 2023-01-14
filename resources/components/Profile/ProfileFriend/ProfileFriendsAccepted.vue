<template>
    <ProfileFriendsList :friends="friends" type="accepted"></ProfileFriendsList>
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
        axios.get('/api/profile/friends?type=accepted').then((resp) => {
            self.friends = resp.data
        })
    },
}
</script>

<style scoped>

</style>
