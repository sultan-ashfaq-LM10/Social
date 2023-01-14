<template>
  <div>
      <CreatePost @post-created="getPosts"></CreatePost>
      <ListPost :posts="posts"></ListPost>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'
import CreatePost from '../Post/PostCreate.vue'
import ListPost from '../Post/PostList.vue'

export default {
  components: { CreatePost, ListPost },

  computed: {
    ...mapState({
      posts: (state) => state.home.posts,
    }),
  },

  methods: {
    ...mapActions({
      apiGetHomePosts: 'home/apiGetPosts',
    }),

    getPosts() {
      this.apiGetHomePosts()
    },
  },

  mounted() {
    this.getPosts()
  },
}
</script>
