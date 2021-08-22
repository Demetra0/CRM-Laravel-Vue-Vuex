<template>
    <div class="form-content">
        <div class="container">

            <!--    Спиннер    -->
            <div v-if="loading">
                <b-spinner
                    label="Loading..."
                    :variant="'primary'"
                    :key="'primary'"
                />
            </div>

            <div class="col-12 col-lg-5 form-main" v-else>
                <RegisterForm/>
            </div>

        </div>
    </div>
</template>

<script>
import RegisterForm from "../components/RegisterForm/RegisterForm";

export default {
    data() {
        return {
            name: 'Register',
            loading: true, // показывать спиннер во время загрузки
        }
    },
    components: {
        RegisterForm,
    },
    methods: {},
    mounted() {
        if (this.$store.state.token !== '') {
            axios.post('/api/auth/checkToken', {token: this.$store.state.token})
                .then(res => {
                    this.loading = false
                    if (res.data.success) {
                        this.$router.push('/users')
                    } else {
                        this.$store.commit('setToken', res.data.token)
                    }
                })
                .catch(err => {
                    this.loading = false
                    this.$store.commit('clearToken')
                    this.$store.commit('logout')
                })
        } else {
            this.loading = false
        }
    },
    computed: {
        regError() {
            return this.$store.getters.regError
        }
    }
}
</script>

<style lang="scss">
</style>
