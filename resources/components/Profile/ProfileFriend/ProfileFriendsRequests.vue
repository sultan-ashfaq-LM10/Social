<template>
  <FriendsList
    :friends="friends"
    type="Request"
    @updateFriendsList="updateFriendsList"
  />
</template>

<script>
import { mapActions } from 'vuex'
import FriendsList from '../../Partials/FriendsList.vue'
export default {
  components: { FriendsList },

  data () {
    return {
      friends: []
    }
  },

  mounted () {
    this.getFriendsRequests()
  },

  methods: {
    ...mapActions({
      apiGetFriendsRequest: 'profileFriends/apiGetFriendsRequest'
    }),

    getFriendsRequests () {
      const self = this
      const promise = this.apiGetFriendsRequest()
      promise.then(function (resp) {
        self.friends = resp
      })
    },

    updateFriendsList(friendId){
      this.friends = this.friends.filter(friend => friend.id !== friendId)
    },
  }
}
</script>

<style scoped>

</style>
