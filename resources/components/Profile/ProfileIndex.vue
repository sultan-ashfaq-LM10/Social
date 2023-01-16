<template>
  <div class="columns is-mobile is-centered">
    <div class="column is-four-fifths has-background-white my-6">
      <b-tabs
        type="is-boxed"
        destroy-on-hide
      >
        <b-tab-item
          label="Posts"
          icon="google-photos"
        >
          <Posts />
        </b-tab-item>
        <b-tab-item
          label="Friends"
          icon="library-music"
        >
          <Friends />
        </b-tab-item>
        <b-tab-item
          label="Details"
          icon="video"
        />

        <Details />

      </b-tabs>
    </div>
  </div>
</template>

<script>
import Posts from './ProfilePosts.vue'
import Friends from './ProfileFriend/ProfileFriendsIndex.vue'
import Details from './ProfileDetails.vue'
export default {
  components: { Posts, Friends, Details }
}
</script>
