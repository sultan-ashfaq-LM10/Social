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
      posts: (state) => state.profile.posts,
    }),
  },

  methods: {
    ...mapActions({
      apiGetPosts: 'profile/apiGetPosts',
    }),

    getPosts() {
      this.apiGetPosts()
    },
  },

  mounted() {
    this.getPosts()
  },
}
</script>
