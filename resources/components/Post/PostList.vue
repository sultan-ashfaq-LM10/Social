<template>
  <div>
    <transition-group name="list" tag="div">
      <div
        v-for="post in posts"
        :key="post.id"
        class="column is-half is-offset-one-quarter p-3 has-background-white box"
      >
        <PartialPostItem
          :post="post"
          @deletePost="$emit('deletePost', $event)"
        />
      </div>
    </transition-group>
    <div
      v-infinite-scroll="loadMore"
      class="loading-container column is-half is-offset-one-quarter p-3"
    >
      <div v-if="loading" class="loading-text">
        <b-icon pack="fas" icon="sync-alt" size="is-large" custom-class="fa-spin"> </b-icon>
      </div>
    </div>
  </div>
</template>

<script>
import PartialPostItem from '../Partials/PartialPostItem.vue'
import InfiniteScroll from 'vue-infinite-scroll'

export default {
  components: { PartialPostItem },
  directives: {
    InfiniteScroll,
  },
  props: ['posts', 'loading'],
  // props: {
  //   posts: {
  //     type: Array,
  //     default: null,
  //   },
  //   loading: {
  //     type: Boolean,
  //     default: false,
  //   }
  // },
  methods: {
    loadMore() {
      this.isLoading = true
      this.$emit('loadMorePosts')
    },
  },
}
</script>
