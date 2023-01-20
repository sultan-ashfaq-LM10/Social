<template>
  <div>

    <b-field label="Full Name">
      <b-input v-model="name" />
    </b-field>

    <b-field label="Email">
      <b-input v-model="email" />
    </b-field>

    <b-field label="Password">
      <b-input v-model="password" type="password" value="" password-reveal />
    </b-field>
    <b-field label="Confirm Password">
      <b-input v-model="password_confirmation" type="password" value="" password-reveal />
    </b-field>

    <b-button type="is-primary is-light" @click="submitRegistration"> Signup </b-button>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: ""
    };
  },

  methods: {
    ...mapActions({
      apiGetAuthUser: 'apiGetAuthUser'
    }),

    submitRegistration() {
      const self = this;
      axios
        .get("/sanctum/csrf-cookie")
        .then(response => {
          axios
            .post("/register", {
              name: this.name,
              email: this.email,
              password: this.password,
              password_confirmation: this.password_confirmation
            })
            .then(re => {
              self.apiGetAuthUser()
            });
        });
    }
  }
}
</script>

<style scoped></style>
