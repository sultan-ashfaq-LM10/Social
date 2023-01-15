<template>
  <FriendsList
    :friends="friends"
    type="pending"
    @updateFriendsList="apiGetFriendsPending()"
  />
</template>

<script>
import { mapState, mapActions } from 'vuex'
import FriendsList from '../../Partials/FriendsList.vue'

export default {
  components: { FriendsList },
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
