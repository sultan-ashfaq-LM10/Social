<template>
  <transition-group name="list" tag="div" class="meme">
    <div
      v-for="friend in friends"
      :key="friend.id"
      class="p-3 has-background-white box"
    >
      <div class="is-flex">
        <img class="homefeed-placeholder-img mx-2" :src="friend.user?.avatar" />
        <span>{{ friend.user.name }}</span>

        <span
          v-if="type === 'accepted'"
          class="button is-danger is-light show-on-right"
          @click="removeFriend(friend.id)"
          >Remove Friend</span
        >
        <span
          v-else-if="type === 'pending'"
          class="button is-light show-on-right"
          @click="removeFriend(friend.id)"
          >Cancel Request</span
        >
        <span
           v-else-if="type === 'request'"
          class="button is-danger is-light show-on-right"
          @click="removeFriend(friend.id)"
          >Reject Request</span
        >
        <span
           v-else-if="type === 'search'"
           class="button is-danger is-light show-on-right"
           @click="addFriend(friend.id)"
        >Add Friend</span
        >
      </div>
    </div>
  </transition-group>
</template>

<script>
export default {
  props: ["friends", "type"],

  methods: {
    removeFriend(friendId) {
      let self = this
      axios.delete(`/api/profile/friends/${friendId}`).then(resp => {
        if (resp.data) {
          self.toastSuccess('Friend removed')
          self.$emit('updateFriendsList')
        }
      })
    },

    // addFriend(userId) {
    //   let self = this
    //   axios.post(`/api/profile/friends`, {
    //     'user_id': userId
    //   }).then(resp => {
    //     if (resp.data) {
    //       self.toastSuccess('Friend removed')
    //       self.$emit('updateFriendsList')
    //     }
    //   })
    // },

  },
};
</script>

<style scoped>
.show-on-right {
  margin-left: auto;
}
</style>
