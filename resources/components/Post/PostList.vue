<template>
  <div>
    <transition-group
      name="list"
      tag="div"
      class="meme"
    >
      <div
        v-for="post in posts"
        :key="post.id"
        class="column is-half is-offset-one-quarter p-3 has-background-white box"
      >
        <PartialPostItem :post="post" @deletePost="$emit('deletePost', $event)" />
      </div>
    </transition-group>
  </div>
</template>

<script>

import PartialPostItem from "../Partials/PartialPostItem.vue";

export default {
  components: {PartialPostItem},
  props: {
    posts: {
      type: Array,
      default: null
    }
  },

}
</script>
