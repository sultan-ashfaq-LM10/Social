<template>
  <FriendsList
    :friends="friends"
    type="Accepted"
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
    this.getFriendsAccepted()
  },

  methods: {
    ...mapActions({
      apiGetFriendsAccepted: 'profileFriends/apiGetFriendsAccepted'
    }),

    getFriendsAccepted () {
      const self = this
      const promise = this.apiGetFriendsAccepted()
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

<style scoped></style>
