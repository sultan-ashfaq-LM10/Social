<template>
  <FriendsList
    :friends="friends"
    type="Pending"
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
      friends: (state) => state.profileFriends.pendingFriends
    })
  },

  mounted () {
    this.apiGetFriendsPending()
  },

  methods: {
    ...mapActions({
      apiGetFriendsPending: 'profileFriends/apiGetFriendsPending'
    })
  }
}
</script>

<style scoped></style>
