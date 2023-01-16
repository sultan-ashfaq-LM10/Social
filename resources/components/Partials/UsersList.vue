<template>
  <transition-group name="list" tag="div" class="meme">
    <div v-for="user in users" :key="user.user.id" class="p-3 has-background-white box">
      <div class="is-flex">
        <img class="homefeed-placeholder-img mx-2" :src="user.avatar" />
        <span>{{ user.user.name }}</span>
        <span v-if="user.friendRelationship?.status === 'PENDING'" class="show-on-right">
          <span
            v-if="user.friendRelationship?.user_id == user.user.id"
            class="show-on-right"
            >
            <span class="button is-success is-light">Accept</span>
            <span class="button is-danger is-light">Reject</span>

          </span
          >
          <span v-else class="button is-danger is-light">Cancel Request</span>
          </span>
        <span
          v-else-if="user.friendRelationship?.status === 'ACCEPTED'"
          class="button is-danger is-light show-on-right"
          @click="addUser(user.user.id)"
          >Friend</span
        >

        <span v-else class="button is-success is-light show-on-right" @click="addUser(user.user.id)"
          >Add user</span
        >
      </div>
    </div>
  </transition-group>
</template>

<script>
export default {
  props: {
    users: {
      type: Array,
      default: [],
    },
  },

  mounted() {
    console.log(this.users)
  },

  methods: {
    addUser(userId) {
      let self = this
      axios
        .post(`/api/profile/friends`, {
          user_id: userId,
        })
        .then((resp) => {
          if (resp.data) {
            self.toastSuccess('Friend request sent!')
            self.$emit('updateUsersList')
          }
        })
    },
  },
}
</script>

<style scoped>
.show-on-right {
  margin-left: auto;
}
</style>
