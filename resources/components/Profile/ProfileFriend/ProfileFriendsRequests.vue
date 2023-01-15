<template>
  <FriendsList
    :friends="friends"
    type="requests"
  />
</template>

<script>
import FriendsList from '../../Partials/FriendsList.vue'

export default {
  components: { FriendsList },

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
