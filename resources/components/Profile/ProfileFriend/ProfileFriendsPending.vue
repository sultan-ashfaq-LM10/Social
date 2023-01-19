<template>
  <FriendsList
    :friends="friends"
    type="Pending"
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
    this.getFriendsPending()
  },

  methods: {
    ...mapActions({
      apiGetFriendsPending: 'profileFriends/apiGetFriendsPending'
    }),

    getFriendsPending() {
      const self = this
      const promise = this.apiGetFriendsPending()
      promise.then(function (resp) {
        self.friends = resp
      })
    },

    updateFriendsList(friendId) {
      console.log(friendId)
      this.friends = this.friends.filter(friend => friend.id !== friendId)
    }
  }
}
</script>

<style scoped></style>
