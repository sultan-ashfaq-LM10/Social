<template>
  <div>
    <CreatePost @post-created="updatePostList" />
    <div
      v-show="showSkeleton"
      class="column is-half is-offset-one-quarter p-3 has-background-white box"
    >
      <Skeleton />
    </div>
    <PostList :posts="posts" @deletePost="handleDeletePost" />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import CreatePost from '../Post/PostCreate.vue'
import PostList from '../Post/PostList.vue'
import Skeleton from '../Skeleton.vue'

export default {
  components: { CreatePost, PostList, Skeleton },

  data () {
    return {
      posts: [],
      showSkeleton: true
    }
  },

  // computed: {
  //   posts () {
  //     return this.$store.state.post.homePosts
  //   }
  // },

  mounted () {
    this.getPosts()
  },

  methods: {
    ...mapActions({
      apiGetHomePosts: 'home/apiGetPosts'
    }),

    getPosts () {
      const self = this
      const promise = this.apiGetHomePosts()
      promise.then(function (resp) {
        // self.$store.commit('post/setHomePosts', resp)
        self.posts = resp
        self.showSkeleton = false
      })
    },

    updatePostList (post, status) {
      if (status == 'EVERYONE') {
        this.posts = [post, ...this.posts]
      }
    },

    handleDeletePost (postId) {
      let self = this
      let promise = this.$store.dispatch('post/apiDeletePost', postId)
      promise.then((resp) => {
        if (resp.status == 204) {
          self.removePostFromList(postId)
        }
      })
    },
    removePostFromList(postId) {
      // creates a new copy of the homePosts array
      //  is better practice when it comes to keeping the state immutable.
      //  This will make it easier to debug, track changes and also to implement time travel debugging
      this.posts = [...this.posts.filter((item) => item.id !== postId)]

      // modifies the existing array
      // modifying the existing array is faster and less memory-intensive,
      // which may be more suitable if performance is a concern and
      // you don't need to keep track of the previous state.
      // state.homePosts = state.homePosts.filter((item) => item.id !== postId)

      //In summary, it's better to create a new copy of the state object, but it's also important to evaluate whether the performance trade-off is worth it.
    },
  }
}
</script>
