<template>
  <UsersList
    :friends="friends"
    type="accepted"
    @updateFriendsList="apiGetFriendsAccepted()"
  ></UsersList>
</template>

<script>
import { mapState, mapActions } from "vuex";
import UsersList from "../../Partials/UsersList.vue";
export default {
  components: { UsersList },
  computed: {
    ...mapState({
      friends: (state) => state.profile.acceptedFriends,
    }),
  },

  methods: {
    ...mapActions({
      apiGetFriendsAccepted: "profile/apiGetFriendsAccepted",
    }),
  },

  mounted() {
    this.apiGetFriendsAccepted();
  },
};
</script>

<style scoped></style>
