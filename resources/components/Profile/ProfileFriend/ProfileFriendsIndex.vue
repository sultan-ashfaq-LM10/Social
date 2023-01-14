<template>
  <div>
      <div class="is-flex is-justify-content-center">
      <b-tabs type="is-toggle-rounded">
          <b-tab-item label="My Friends" icon="google-photos">
              <ProfileFriendsAccepted/>
          </b-tab-item>
          <b-tab-item label="Pending Friends" icon="video">
              <ProfileFriendsPending/>
          </b-tab-item>
          <b-tab-item label="Friend Requests" icon="video">
          </b-tab-item>
      </b-tabs>
      </div>
  </div>
</template>

<script>
import ProfileFriendsAccepted from "./ProfileFriendsAccepted.vue";
import ProfileFriendsPending from "./ProfileFriendsPending.vue";

export default {
    components: {ProfileFriendsPending, ProfileFriendsAccepted},

}
</script>
