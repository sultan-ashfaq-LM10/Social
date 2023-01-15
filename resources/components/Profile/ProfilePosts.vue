<template>
  <div>
    <CreatePost @post-created="getPosts" />
    <ListPost :posts="posts" />
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
      posts: (state) => state.profile.posts
    })
  },

  mounted () {
    this.getPosts()
  },

  methods: {
    ...mapActions({
      apiGetPosts: 'profile/apiGetPosts'
    }),

    getPosts () {
      this.apiGetPosts()
    }
  }
}
</script>
