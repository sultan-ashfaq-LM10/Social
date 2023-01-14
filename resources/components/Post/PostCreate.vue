<template>
    <div class="column is-half is-offset-one-quarter p-3 has-background-white box">
        <b-field label="Create Post">
            <b-input maxlength="1000" type="textarea" v-model="content"></b-input>
        </b-field>
        <div class="is-flex is-justify-content-space-between">
          <span>
            <b-field>
              <b-radio-button v-model="type" size="is-small" name="type" native-value="0">
                <i class="fa-solid fa-bullhorn mr-1"></i> Public
              </b-radio-button>
              <b-radio-button v-model="type" size="is-small" name="type" native-value="1">
                <i class="fa-solid fa-lock mr-1"></i> Private
              </b-radio-button>
              <b-radio-button v-model="type" size="is-small" name="type" native-value="2">
                <i class="fa-solid fa-earth-americas mr-1"></i> Everyone</b-radio-button
              >
            </b-field>
          </span>
            <button class="button is-light" @click="submitPost">Submit Post</button>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    data() {
        return {
            content: '',
            type: '0',
        }
    },

    methods: {
        // Vuex store actions
        ...mapActions({
            apiStorePost: 'post/apiStorePost',
        }),

        submitPost(){
            let self = this
            let payload = {
                content: this.content,
                type: this.type
            }
            let apiStorePostPromise = this.apiStorePost(payload)
            apiStorePostPromise.then(function (resp) {
                if (resp.status === 200) {
                    //post successfully created
                    self.content = ''
                    self.toastSuccess('Post successfully created!')
                    self.$emit('post-created')
                    return
                }
                if (resp.status === 422) {
                    console.log(resp.data.message)
                }
            })
        },
    },
}
</script>
