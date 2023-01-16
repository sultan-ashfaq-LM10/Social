<template>
  <FriendsList
    :friends="friends"
    type="Request"
  />
</template>

<script>
import { mapState, mapActions } from 'vuex'
import FriendsList from '../../Partials/FriendsList.vue'
export default {
  components: { FriendsList },

  computed: {
    ...mapState({
      friends: (state) => state.profileFriends.requestFriends
    })
  },

  mounted () {
    this.apiGetFriendsRequest()
  },

  methods: {
    ...mapActions({
      apiGetFriendsRequest: 'profileFriends/apiGetFriendsRequest'
    })
  }
}
</script>

<style scoped>

</style>
