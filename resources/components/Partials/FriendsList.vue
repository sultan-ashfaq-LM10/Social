<template>
  <transition-group
    name="list"
    tag="div"
    class="meme"
  >
    <div
      v-for="friend in friends"
      :key="friend.id"
      class="p-3 has-background-white box"
    >
      <div class="is-flex">
        <img
          class="homefeed-placeholder-img mx-2"
          :src="friend.user?.avatar"
        >
        <span>{{ friend.user.name }}</span>

        <span
          v-if="type === 'Accepted'"
          class="button is-danger is-light show-on-right"
          @click="deleteFriend(friend.id, type)"
        >Remove Friend</span>
        <span
          v-else-if="type === 'Pending'"
          class="button is-light show-on-right"
          @click="deleteFriend(friend.id, type)"
        >Cancel Request</span>
        <span
          v-else-if="type === 'Request'"
          class="show-on-right"
        >
          <span class="button is-success is-light " @click="acceptFriend(friend.id)">Accept</span>
          <span class="button is-danger is-light " @click="deleteFriend(friend.id, type)">Reject</span>
        </span>
      </div>
    </div>
  </transition-group>
</template>

<script>
import {mapActions} from "vuex";

export default {
  props: {
    friends: {
      type: Array,
      default: () => []
    },
    type: {
      type: String,
      default: ''
    }
  },

  methods: {
    ...mapActions({
      'apiUpdateFriendsRequest' : 'profileFriends/apiUpdateFriendsRequest',
      'apiDeleteFriendsRequest' : 'profileFriends/apiDeleteFriendsRequest'
    }),

    acceptFriend (friendId){
      const self = this
      let payload = {id: friendId, type: 1}
      let apiUpdateFriendsRequestPromise = this.apiUpdateFriendsRequest(payload)
      apiUpdateFriendsRequestPromise.then(function (resp){
        // if (resp) {
          self.toastSuccess('Friend added!')
        self.$emit('updateFriendsList', friendId)
        // }
      })
    },

    deleteFriend (friendId, tabType) {
      const self = this
      let payload = {id: friendId, tabType}

      let apiDeleteFriendPromise = this.apiDeleteFriendsRequest(payload)
      apiDeleteFriendPromise.then(function (resp){
        if (resp) {
          self.toastSuccess('Friend removed!')
          console.log(friendId)
          self.$emit('updateFriendsList', friendId)
        }
      })
    }

  }
}
</script>

<style scoped>
.show-on-right {
  margin-left: auto;
}
</style>
