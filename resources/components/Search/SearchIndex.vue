<template>
  <div class="columns is-mobile is-centered">
    <div class="column is-three-fifths has-background-white my-6">
      <b-field>
        <b-input
          v-model="query"
          placeholder="Search people"
          type="search"
          icon="magnify"
          expanded
        />
        <p class="control">
          <b-button
            type="is-primary"
            label="Search"
            @click="searchUsers"
          />
        </p>
      </b-field>

      <UsersList
        :friends="friends"
        type="accepted"
      />
    </div>
  </div>
</template>

<script>
import UsersList from '../Partials/UsersList.vue'
export default {
  components: { UsersList },

  data () {
    return {
      query: ''
    }
  },

  mounted () {
  },

  methods: {
    searchUsers () {
      this.apiSearchUsers(this.query)
    },

    apiSearchUsers (query) {
      axios.get(`/api/search/users?query=${this.query}`).then((resp) => {
        console.log(resp.data)
      })
    }
  }
}

</script>
