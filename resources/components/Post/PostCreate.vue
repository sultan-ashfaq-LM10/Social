<template>
  <div class="column is-half is-offset-one-quarter p-3 has-background-white box">
    <b-field label="Create Post">
      <b-input
        v-model="content"
        maxlength="1000"
        type="textarea"
      />
    </b-field>
    <div class="is-flex is-justify-content-space-between">
      <span>
        <b-field>
          <b-radio-button
            v-model="type"
            size="is-small"
            name="type"
            native-value="0"
          >
            <i class="fa-solid fa-bullhorn mr-1" /> Public
          </b-radio-button>
          <b-radio-button
            v-model="type"
            size="is-small"
            name="type"
            native-value="1"
          >
            <i class="fa-solid fa-lock mr-1" /> Private
          </b-radio-button>
          <b-radio-button
            v-model="type"
            size="is-small"
            name="type"
            native-value="2"
          >
            <i class="fa-solid fa-earth-americas mr-1" /> Everyone</b-radio-button>
        </b-field>
      </span>
      <button
        class="button is-light"
        @click="submitPost"
      >
        Submit Post
      </button>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      content: '',
      type: '0'
    }
  },

  methods: {
    // Vuex store actions
    ...mapActions({
      apiStorePost: 'post/apiStorePost'
    }),

    submitPost () {
      const self = this
      const payload = {
        content: this.content,
        type: this.type
      }
      const apiStorePostPromise = this.apiStorePost(payload)
      apiStorePostPromise.then(function (resp) {
        if (resp.status === 200) {
          self.content = ''
          self.toastSuccess('Post successfully created!')
          self.$emit('post-created', resp.data)
          return
        }
        if (resp.status === 422) {
          console.log(resp.data.message)
        }
      })
    }
  }
}
</script>
