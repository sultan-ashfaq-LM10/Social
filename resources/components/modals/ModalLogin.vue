<template>
    <section>
        <b-button
            label="Login"
            type="is-primary"
            size="is-medium"
            @click="isComponentModalActive = true" />

        <b-modal
            v-model="isComponentModalActive"
            has-modal-card
            trap-focus
            :destroy-on-hide="false"
            aria-role="dialog"
            aria-label="Example Modal"
            close-button-aria-label="Close"
            aria-modal>
            <template #default="props">
                <modal-form v-bind="formProps" @close="props.close" @submit-login="submitLogin"></modal-form>
            </template>
        </b-modal>
    </section>
</template>

<script>
const ModalForm = {
    data(){
      return{
      }
    },
    props: ['canCancel'],
    computed: {
        email() {
            return ''
        },
        password() {
            return ''
        },
    },

    template: `
            <form action="">
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Login</p>
                        <button
                            type="button"
                            class="delete"
                            @click="$emit('close')"/>
                    </header>
                    <section class="modal-card-body">
                        <b-field label="Email">
                            <b-input
                                type="email"
                                v-model="email"
                                :value="email"
                                placeholder="Your email"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="Password">
                            <b-input
                                type="password"
                                v-model="password"
                                :value="password"
                                password-reveal
                                placeholder="Your password"
                                required>
                            </b-input>
                        </b-field>

                        <b-checkbox>Remember me</b-checkbox>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="$emit('close')" />
                        <b-button
                            label="Login"
                            @click="$emit('submit-login')"
                            type="is-primary" />
                    </footer>
                </div>
            </form>
        `
}

export default {
    components: {
        ModalForm
    },
    data() {
        return {
            isComponentModalActive: false,
        }
    },
    computed:{
        formProps(){
            return {
                email: '',
                password: ''
            }
        }
    },

    methods: {
        submitLogin(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    "email": this.formProps.email,
                    "password": this.formProps.password
                }).then(re => {
                    console.log(re)
                })
            });
        }
    }
}
</script>
