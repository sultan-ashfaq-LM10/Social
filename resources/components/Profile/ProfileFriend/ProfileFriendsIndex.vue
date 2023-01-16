<template>
  <div>
    <div class="is-flex is-justify-content-center">
      <b-tabs type="is-toggle-rounded" destroy-on-hide>
        <b-tab-item
          label="My Friends"
          icon="google-photos"
        >
          <ProfileFriendsAccepted />
        </b-tab-item>
        <b-tab-item
          label="Pending Friends"
          icon="video"
        >
          <ProfileFriendsPending />
        </b-tab-item>
        <b-tab-item
          label="Friend Requests"
          icon="video">
          <ProfileFriendsRequests />
        </b-tab-item>
      </b-tabs>
    </div>
  </div>
</template>

<script>
import ProfileFriendsAccepted from './ProfileFriendsAccepted.vue'
import ProfileFriendsPending from './ProfileFriendsPending.vue'
import ProfileFriendsRequests from "./ProfileFriendsRequests.vue";

export default {
  components: {ProfileFriendsRequests, ProfileFriendsPending, ProfileFriendsAccepted }

}
</script>
