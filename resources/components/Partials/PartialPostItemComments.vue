<template>
  <div>
    <transition-group name="list" tag="div">
      <div v-for="comment in post.comments" :key="comment.id">
        <img class="homefeed-comment-placeholder-img mx-2 is-pulled-left" :src="comment.user.avatar" />
          <div class="post-comment-wrapper p-2 ml-6 mb-3">
            <b-tooltip
               v-if="$store.state.authUser.id == comment.user.id"
               class="ml-auto is-pulled-right"
               label="Remove comment"
               type="is-danger"
               position="is-bottom"
            >
              <b-icon
                 class="is-clickable"
                 @click.native="deleteComment(post.id, comment.id)"
                 pack="fas"
                 icon="times"
                 size="is-medium"
                 type="is-danger"
              />
            </b-tooltip>
            <span class="has-text-weight-bold">{{ comment.user.name }}</span>
            <br />
            <span>
              {{ comment.body }}
            </span>
          </div>
      </div>
    </transition-group>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      default: null,
    },
  },

  methods: {
    deleteComment(postId, commentId) {
      console.log('PartialPostItemComments.vue: deleteComment()');
      this.$emit('deleteComment', {postId, commentId})
    },
  }
}
</script>

<style scoped>
img{
  position: relative;
  top: 0.5em
}
span {
  font-size: 0.8em;
}
.post-comment-wrapper {
  background-color: rgb(242, 242, 242);
  border-radius: 0.5em;
}
</style>
