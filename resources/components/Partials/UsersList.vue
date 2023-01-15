<template>
  <transition-group
    name="list"
    tag="div"
    class="meme"
  >
    <div
      v-for="user in users"
      :key="user.id"
      class="p-3 has-background-white box"
    >
      <div class="is-flex">
        <img
          class="homefeed-placeholder-img mx-2"
          :src="user.avatar"
        >
        <span>{{ user.name }}</span>
        <span
          class="button is-danger is-light show-on-right"
          @click="addUser(user.id)"
        >Add user</span>
      </div>
    </div>
  </transition-group>
</template>

<script>
export default {
  props: {
    users: {
      type: Array,
      default: []
    },
    type: {
      type: String,
      default: ''
    }
  },

  methods: {

    addUser(userId) {
      let self = this
      axios.post(`/api/profile/friends`, {
        'user_id': userId
      }).then(resp => {
        if (resp.data) {
          self.toastSuccess('Friend request sent!')
          self.$emit('updateUsersList')
        }
      })
    },

  }
}
</script>

<style scoped>
.show-on-right {
  margin-left: auto;
}
</style>
