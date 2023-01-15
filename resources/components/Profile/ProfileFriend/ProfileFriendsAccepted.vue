<template>
  <FriendsList
    :friends="friends"
    type="accepted"
    @updateFriendsList="apiGetFriendsAccepted()"
  />
</template>

<script>
import { mapState, mapActions } from 'vuex'
import FriendsList from '../../Partials/FriendsList.vue'
export default {
  components: { FriendsList },

  computed: {
    ...mapState({
      friends: (state) => state.profile.acceptedFriends
    })
  },

  mounted () {
    this.apiGetFriendsAccepted()
  },

  methods: {
    ...mapActions({
      apiGetFriendsAccepted: 'profile/apiGetFriendsAccepted'
    })
  }
}
</script>

<style scoped></style>
