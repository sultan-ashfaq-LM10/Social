<template>
  <div>
    <div class="is-flex">
      <img class="homefeed-placeholder-img mx-2" :src="post.user.avatar" />
      <span>{{ post.user.name }}</span>
    </div>
    <div>
      <span class="is-size-7"> {{ post.updated_at }} </span>
      <span v-if="post.type === 'PUBLIC'">
        <b-tooltip label="Public" type="is-dark" position="is-bottom">
          <i class="fa-solid fa-bullhorn mx-1" style="font-size: 0.7em" />
        </b-tooltip>
      </span>
      <span v-else-if="post.type === 'EVERYONE'">
        <b-tooltip label="Everyone" type="is-dark" position="is-bottom">
          <i class="fa-solid fa-earth-americas mx-1" style="font-size: 0.7em" />
        </b-tooltip>
      </span>
      <span v-else-if="post.type === 'PRIVATE'">
        <b-tooltip label="Private" type="is-dark" position="is-bottom">
          <i class="fa-solid fa-lock mx-1" style="font-size: 0.7em" />
        </b-tooltip>
      </span>
    </div>
    <div class="m-3">
      <p>
        {{ post.content }}
      </p>
    </div>

    <div>
      <div class="m-3 is-inline">
        <b-tooltip label="Total likes" type="is-dark" position="is-bottom">
          <b-icon pack="fas" icon="thumbs-up" size="is-medium" type="is-primary" />
          {{ post.likes.length }}
        </b-tooltip>
      </div>
      <div class="m-3 is-inline">
        <b-tooltip label="Total comments" type="is-dark" position="is-bottom">
          <b-icon pack="fas" icon="comment" size="is-medium" type="is-primary" />
          {{ post.comments.length}}
        </b-tooltip>
      </div>
    </div>
    <div class="d-block">
      <hr />
      <b-button v-if="isLiked" size="is-small" type="is-primary" @click="likePost(post.id, false)">
        ><b-icon pack="fas" icon="thumbs-up" size="is-medium" type="is-secondary" />
        <span> Unlike</span>
      </b-button>

      <b-button v-else size="is-small" type="is-primary" @click="likePost(post.id, true)">
        <b-icon pack="fas" icon="thumbs-up" size="is-medium" type="is-secondary" />
        <span> Like</span>
      </b-button>


      <b-button size="is-small is-pulled-right " type="is-primary">
        ><b-icon pack="fas" icon="comment" size="is-medium" type="is-secondary" />
        <span>Comment</span>
      </b-button>
      <hr />
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  props: {
    post: {
      type: Object,
      default: null,
    },
  },
  computed: {
    isLiked() {
      return this.post.likes.some((like) => like.user.id === this.$store.state.authUser.id)
    },
  },

  methods: {
    ...mapActions({
      apiStoreLike: 'post/apiStoreLike',
    }),


    likePost(postId, status) {
      let self = this
      let apiStoreLikePromise = this.apiStoreLike(postId)
      apiStoreLikePromise.then(function (resp) {
        let newLikes = resp.likes
        // compare newLikes with self.post.likes and if newLike is not in self.post.likes then add it
        if (status === true) {
          newLikes.forEach((newLike) => {
            if (!self.post.likes.some((like) => like.id === newLike.id)) {
              self.post.likes.push(newLike)
            }
          })
          return
        }
        // compare self.post.likes with newLikes and if self.post.likes is not in newLikes then remove it
        self.post.likes.forEach((like) => {
          if (!newLikes.some((newLike) => newLike.id === like.id)) {
            self.post.likes.splice(self.post.likes.indexOf(like), 1)
          }
        })
      })
    },
  },
}
</script>

<style scoped>
hr {
  margin: 0.5rem 0 !important;
}
</style>
