<template>
  <div>
    <div v-for="comment in post.comments">
      <img class="homefeed-comment-placeholder-img mx-2 is-pulled-left" :src="comment.user.avatar" />
        <div class="post-comment-wrapper p-2 ml-6 mb-3">
          <span class="has-text-weight-bold">{{ comment.user.name }}</span>
          <br />
          <span>
            {{ comment.body }}
          </span>
        </div>
    </div>
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
