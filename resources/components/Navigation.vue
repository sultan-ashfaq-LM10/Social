<template>
  <b-navbar fixed-top centered shadow>
    <template #brand>
      <b-navbar-item>
        <img src="/images/social-logo-transparent.svg" alt="Social" />
      </b-navbar-item>
    </template>
    <template #start>
      <b-navbar-item class="px-5" tag="router-link" :to="{ name: 'Search' }">
        <b-tooltip label="Search Users" type="is-dark" position="is-bottom">
          <b-icon pack="fas" icon="search" size="is-medium"> </b-icon>
        </b-tooltip>
      </b-navbar-item>
      <b-navbar-item class="px-5 is-active-helper" tag="router-link" :to="{ name: 'HomeFeed' }">
        <b-tooltip label="Home Feed" type="is-dark" position="is-bottom">
          <b-icon pack="fas" icon="home" size="is-medium"> </b-icon>
        </b-tooltip>
      </b-navbar-item>

      <b-navbar-item class="px-5 is-active-helper" tag="router-link" :to="{ name: 'Profile' }">
        <b-tooltip label="Profile" type="is-dark" position="is-bottom">
          <b-icon pack="fas" icon="user" size="is-medium"> </b-icon>
        </b-tooltip>
      </b-navbar-item>
    </template>

    <template #end>
      <b-navbar-item tag="div">
        <div v-if="authUser != null">
          <span style="position: relative; top: 7px"
            >Welcome, {{ authUser.name }}</span
          >
          <span class="button is-danger" @click="logout">logout</span>
        </div>
        <div v-else>
          <span>Please login to use the site!</span>
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
</template>

<script>
import LoginModal from "./modals/ModalLogin.vue";
import { mapActions, mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      authUser: (state) => state.authUser,
    }),
  },

  methods: {
    ...mapActions({
      logout: "logout",
    }),
  },

  components: { LoginModal },
};
</script>

<style scoped></style>
