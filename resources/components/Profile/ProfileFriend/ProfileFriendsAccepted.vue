<template>
  <UsersList
    :friends="friends"
    type="accepted"
    @updateFriendsList="apiGetFriendsAccepted()"
  />
</template>

<script>
import { mapState, mapActions } from 'vuex'
import UsersList from '../../Partials/UsersList.vue'
export default {
  components: { UsersList },

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
