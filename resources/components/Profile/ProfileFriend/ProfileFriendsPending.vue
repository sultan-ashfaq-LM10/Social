<template>
  <UsersList
    :friends="friends"
    type="pending"
    @updateFriendsList="apiGetFriendsPending()"
  />
</template>

<script>
import { mapState, mapActions } from 'vuex'
import UsersList from '../../Partials/UsersList.vue'

export default {
  components: { UsersList },
  computed: {
    ...mapState({
      friends: (state) => state.profile.pendingFriends
    })
  },

  mounted () {
    this.apiGetFriendsPending()
  },

  methods: {
    ...mapActions({
      apiGetFriendsPending: 'profile/apiGetFriendsPending'
    })
  }
}
</script>

<style scoped></style>
