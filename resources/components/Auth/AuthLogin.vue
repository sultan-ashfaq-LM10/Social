<template>
  <div>
    <b-field label="Email">
      <b-input v-model="email"></b-input>
    </b-field>
    <b-field label="Password">
      <b-input v-model="password" type="password" value="" password-reveal> </b-input>
    </b-field>
    <b-button type="is-primary is-light" @click="submitLogin">Login</b-button>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },

  methods: {
    ...mapActions({
      apiGetAuthUser: 'apiGetAuthUser',
    }),

    submitLogin() {
      let self = this
      axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
          .post('/login', {
            email: this.email,
            password: this.password,
          })
          .then((re) => {
            self.apiGetAuthUser()
          })
      })
    },
  },
}
</script>
