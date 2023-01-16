<template>
  <FriendsList
    :friends="friends"
    type="Accepted"
  />
</template>

<script>
import { mapState, mapActions } from 'vuex'
import FriendsList from '../../Partials/FriendsList.vue'
export default {
  components: { FriendsList },

  computed: {
    ...mapState({
      friends: (state) => state.profileFriends.acceptedFriends
    })
  },

  mounted () {
    this.apiGetFriendsAccepted()
  },

  methods: {
    ...mapActions({
      apiGetFriendsAccepted: 'profileFriends/apiGetFriendsAccepted'
    })
  }
}
</script>

<style scoped></style>
