<template>
  <div>
    <div class="is-flex">
      <img class="homefeed-post-placeholder-img mx-2" :src="post.user.avatar" />
      <span>{{ post.user.name }}</span>
      <b-tooltip
        v-if="this.$store.state.authUser.id == post.user.id"
        class="ml-auto"
        label="Remove post"
        type="is-danger"
        position="is-bottom"
      >
        <b-icon
          class="is-clickable"
          @click.native="deletePost(post.id)"
          pack="fas"
          icon="times"
          size="is-medium"
          type="is-primary"
        />
      </b-tooltip>
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
          {{ post.comments.length }}
        </b-tooltip>
      </div>
    </div>
    <div class="d-block">
      <hr />
      <b-button v-if="isLiked" size="is-small" type="is-light" @click="likePost(post.id, false)">
        <b-icon pack="fas" icon="thumbs-up" size="is-medium" type="is-primary" />
        <span> Unlike</span>
      </b-button>

      <b-button v-else size="is-small" type="is-light" @click="likePost(post.id, true)">
        <b-icon pack="fas" icon="thumbs-up" size="is-medium" type="is-secondary" />
        <span> Like</span>
      </b-button>

      <b-button size="is-small is-pulled-right " type="is-light" @click="showComments = true">
        <b-icon pack="fas" icon="comment" size="is-medium" type="is-secondary" />
        <span>Comment</span>
      </b-button>
      <hr />

      <b-field>
        <b-input
          placeholder="Write a comment"
          type="search"
          icon-pack="fas"
          icon="comment"
          v-model="commentBody"
          @keyup.native.enter="addComment(post.id)"
        >
        </b-input>
      </b-field>

      <PartialPostItemComments :post="post" v-show="showComments" @deleteComment="deleteComment" />
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import PartialPostItemComments from './PartialPostItemComments.vue'
export default {
  components: { PartialPostItemComments },
  props: {
    post: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      commentBody: '',
      showComments: false,
    }
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

    deletePost(postId) {
      this.$emit('deletePost', postId)
    },

    addComment(postId) {
      // this.$emit('addComment', { postId, body: comment })
      let self = this
      let promise = this.$store.dispatch('post/apiStoreComment', { postId, body: this.commentBody })
      promise.then((resp) => {
        if (resp.status == 200) {
          console.log(resp.data)
          self.post.comments.unshift(resp.data)
          self.commentBody = ''
        }
      })
    },
    deleteComment(payload) {
      let self = this
      let promise = this.$store.dispatch('post/apiDeleteComment', payload)
      promise.then((resp) => {
        console.log(resp)
        if (resp.data) {
          console.log(resp.data)
          self.post.comments.splice(
            self.post.comments.findIndex((comment) => comment.id === payload.commentId),
            1
          )
        }
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
