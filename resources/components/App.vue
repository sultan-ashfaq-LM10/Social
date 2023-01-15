<template>
  <div>
    <Navigation />
    <b-progress
      v-show="isLoading"
      type="is-primary"
      size="is-small"
    />
    <ContentSection v-if="authUser != null" />
    <Auth v-else />
  </div>
</template>

<script>
import Vue from 'vue'
import Navigation from './Navigation.vue'
import ContentSection from './ContentSection.vue'
import Auth from './Auth/AuthIndex.vue'
import { mapActions, mapState } from 'vuex'

export default {
  components: { Navigation, ContentSection, Auth },

  props: {
    authCheck: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    ...mapState({
      authUser: (state) => state.authUser,
      isLoading: (state) => state.isLoading
    })
  },

  mounted () {
    if (this.authCheck === true) {
      this.apiGetAuthUser()
    }
  },

  methods: {
    ...mapActions({
      apiGetAuthUser: 'apiGetAuthUser'
    })
  }
}

Vue.mixin({
  // global methods to use within in the VUE app
  methods: {
    toastSuccess (message, timer = 2000) {
      const ToastSuccess = this.$swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', this.$swal.stopTimer)
          toast.addEventListener('mouseleave', this.$swal.resumeTimer)
        }
      })

      ToastSuccess.fire({
        icon: 'success',
        title: message
      })
    },

    toastError (message) {
      const ToastSuccess = this.$swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', this.$swal.stopTimer)
          toast.addEventListener('mouseleave', this.$swal.resumeTimer)
        }
      })

      ToastSuccess.fire({
        icon: 'error',
        title: message
      })
    },

    swalDelete (title, buttonText) {
      return new Promise((resolve, reject) => {
        this.$swal({
          title,
          showCancelButton: true,
          confirmButtonText: buttonText,
          confirmButtonColor: '#cf3535'
        }).then((result) => {
          resolve(result)
        })
      })
    },

    swalError (text) {
      this.$swal({
        title: 'Error!',
        text,
        icon: 'error',
        confirmButtonText: 'Ok',
        confirmButtonColor: '#1c1919'
      })
    }
  }
})
</script>
