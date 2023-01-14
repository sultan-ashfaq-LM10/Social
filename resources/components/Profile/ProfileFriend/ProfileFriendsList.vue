<template>
  <transition-group name="list" tag="div" class="meme">
    <div v-for="friend in friends" :key="friend.id" class="p-3 has-background-white box">
      <div class="is-flex">
        <img class="homefeed-placeholder-img mx-2" :src="friend.user?.avatar" />
        <span>{{ friend.user.name }}</span>

        <span v-if="type === 'accepted'" class="button is-danger is-light" style="margin-left: auto">Remove Friend</span>
        <span v-if="type === 'pending'" class="button is-light" style="margin-left: auto">Cancel Request</span>
        <span v-if="type === 'request'" class="button is-danger is-light" style="margin-left: auto">Reject Request</span>
      </div>
    </div>
  </transition-group>
</template>

<script>
export default {
  props: ['friends', 'type'],

  mounted() {
    console.log(this.type)
  },
}
</script>
