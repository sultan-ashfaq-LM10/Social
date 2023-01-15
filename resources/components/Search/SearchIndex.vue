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
            @click="apiSearchUsers(query)"
          />
        </p>
      </b-field>

      <UsersList
        :users="users"
        type="accepted"
      />
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from "vuex";
import UsersList from '../Partials/UsersList.vue'
export default {
  components: { UsersList },

  data () {
    return {
      query: ''
    }
  },

  computed: {
    ...mapState({
      users: (state) => state.search.users
    })
  },

  methods: {
    ...mapActions({
      apiSearchUsers: "search/apiSearchUsers"
    }),
  }
}

</script>
