<template>
  <ProfileFriendsList
    :friends="friends"
    type="requests"
  />
</template>

<script>
import ProfileFriendsList from './ProfileFriendsList.vue'

export default {
  components: { ProfileFriendsList },

  data () {
    return {
      friends: []
    }
  },

  mounted () {
    const self = this
    axios.get('/api/profile/friends?type=requests').then((resp) => {
      self.friends = resp.data
    })
  }
}
</script>

<style scoped>

</style>
