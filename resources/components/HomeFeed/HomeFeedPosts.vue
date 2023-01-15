<template>
  <div>
    <CreatePost @post-created="getPosts" />
    <div
      v-show="showSkeleton"
      class="column is-half is-offset-one-quarter p-3 has-background-white box"
    >
      <Skeleton />
    </div>

    <ListPost :posts="posts" />
  </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from 'vuex'
import CreatePost from '../Post/PostCreate.vue'
import ListPost from '../Post/PostList.vue'
import Skeleton from '../Skeleton.vue'

export default {
  components: { CreatePost, ListPost, Skeleton },

  data () {
    return {
      showSkeleton: true
    }
  },

  computed: {
    ...mapState({
      posts: (state) => state.home.posts
    })
  },

  mounted () {
    this.getPosts()
  },

  methods: {
    ...mapActions({
      apiGetHomePosts: 'home/apiGetPosts'
    }),
    ...mapMutations({
      setPosts: 'home/setPosts'
    }),

    getPosts () {
      const self = this
      const promise = this.apiGetHomePosts()
      promise.then(function (resp) {
        self.setPosts(resp)
        self.showSkeleton = false
      })
    }
  }
}
</script>
