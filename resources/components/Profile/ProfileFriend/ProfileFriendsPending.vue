<template>
  <UsersList
    :friends="friends"
    type="pending"
    @updateFriendsList="apiGetFriendsPending()"
  ></UsersList>
</template>

<script>
import { mapState, mapActions } from "vuex";
import UsersList from "../../Partials/UsersList.vue";

export default {
  components: { UsersList },
  computed: {
    ...mapState({
      friends: (state) => state.profile.pendingFriends,
    }),
  },

  methods: {
    ...mapActions({
      apiGetFriendsPending: "profile/apiGetFriendsPending",
    }),
  },

  mounted() {
    this.apiGetFriendsPending();
  },
};
</script>

<style scoped></style>
