<template>
  <section class="mt-6">
    <div class="container d-flex justify-content-center">
        <div class="column is-half is-offset-one-quarter p-3 has-background-white box">
        <b-tabs type="is-toggle" expanded>
        <b-tab-item label="Login" icon="google-photos">
          <Login />
        </b-tab-item>
        <b-tab-item label="Register" icon="library-music">
          <Register />
        </b-tab-item>
      </b-tabs>
        </div>
    </div>
  </section>
</template>

<script>
import Login from './AuthLogin.vue'
import Register from './AuthRegister.vue'
export default {
  components: { Login, Register },
}
</script>

<style scoped></style>
