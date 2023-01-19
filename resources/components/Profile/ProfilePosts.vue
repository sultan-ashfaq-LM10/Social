<template>
  <div>
    <CreatePost @post-created="updatePostList" />
    <div
       v-show="showSkeleton"
       class="column is-half is-offset-one-quarter p-3 has-background-white box"
    >
      <Skeleton />
    </div>
    <PostList :posts="posts"  @deletePost="handleDeletePost" />
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
    // posts () {
    //   return this.$store.state.post.profilePosts
    // }
  // },

  mounted () {
    this.getPosts()
  },

  methods: {
    ...mapActions({
      apiGetPosts: 'profile/apiGetPosts'
    }),

    getPosts () {
      const self = this
      const promise = this.apiGetPosts()
      promise.then(function (resp) {
        // self.$store.commit('post/setProfilePosts', resp)
        self.posts = resp
        self.showSkeleton = false
      })
    },

    updatePostList (post, status) {
      this.posts = [post, ...this.posts]
    },

    handleDeletePost (postId) {
      let self = this
      let promise = this.$store.dispatch('post/apiDeletePost', postId)
      promise.then((resp) => {
        if (resp.status == 204) {
          console.log('store remoe')
          self.removePostFromList(postId)
          // self.$store.commit('post/removeProfilePostFromList', postId)
        }
      })
    },
    removePostFromList(postId) {
      this.posts = [...this.posts.filter((item) => item.id !== postId)]
    },

  }
}
</script>
