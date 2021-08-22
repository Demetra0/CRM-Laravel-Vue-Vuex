<template>
    <div class="user-profile">
        <div class="container">
            <!--      Алерт об ошибке, если в бд нет профилей      -->
            <div v-if="error" style="text-align: center">
                <PrimaryAlert
                    :message="messageError"
                />
            </div>

            <div v-if="!(loading === checkAmount)" style="text-align: center">
                <b-spinner
                    label="Loading..."
                    :variant="'primary'"
                    :key="'primary'"
                />
            </div>

            <div v-else>
                <div class="number-of-profiles col-12">
                    <p>Колличество анкет на рассмотрении: {{ getAmountProfiles }}</p>
                </div>

                <NewUserProfile
                    :profileData="getFirstProfiler"
                />

                <ButtonsManagement
                    textFirstButton="Accept"
                    textSecondButton="Reject"
                    textThirdButton="Delete"
                    :adding="true"
                />
            </div>
        </div>
    </div>
</template>

<script>
import NewUserProfile from "../components/UsersProfile/NewUserProfile";
import ButtonsManagement from "../components/ButtonsManagament/ButtonsManagement";
import axios from 'axios'
import {mapActions, mapGetters} from 'vuex'
import PrimaryAlert from "../components/Alert/PrimaryAlert";

export default {
    data: () => ({
        error: false,           // статус ошибки
        messageError: null,     // сообщение об ошибке с сервера
        loading: false,         // показывать спиннер во время загрузки
        loadProfile: true,      // тоже спиннер, но уже для анкет
        profile: {},            // хранится текущая анкета
        numberOfProfiles: 0,    // количество анкет
    }),
    mounted() {
        // Отправляем на страницу /login, если юзер не авторизировался
        if (this.$store.state.token !== '') {
            if (this.$store.state.google2fa !== '') {
                axios.post('/api/auth/checkToken', {token: this.$store.state.token})
                    .then(res => {
                        if (!res.data.success) {
                            this.$store.commit('setToken', res.data.token)
                        }
                        this.loading = false
                    })
                    .catch(err => {
                        this.loading = false
                        this.$store.commit('clearToken')
                        this.$store.commit('logout')
                        this.$router.push('/login')
                    })
            } else { // Если JWT совпадает, но менеджер не вошел в google 2fa
                this.loading = false
                this.$router.push('/2fa')
            }
        } else {
            this.loading = false
            this.$store.commit('clearToken')
            this.$store.commit('logout')
            this.$router.push('/login')
        }
        this.ajaxFirstProfilerFromDB()

        this.loadProfile = false
    },
    computed: {
        ...mapGetters([
            'getFirstProfiler',
            'getAmountProfiles'
        ]),
        checkAmount() {
            if (!this.getAmountProfiles) {
                this.error = true
                this.messageError = "There are no questionnaires for consideration. But they will definitely appear soon ;)"
                //Метод для проверки данных в бд
                this.updateData()
            } else {
                this.error = false
            }
            return !this.getAmountProfiles
        }
    },
    methods: {
        ...mapActions([
            'ajaxFirstProfilerFromDB'
        ]),
        updateData: function () {
            setInterval(function () {
                this.ajaxFirstProfilerFromDB()
            }.bind(this), 15000);
        }
    },
    connect() {
        clearInterval(this.updateData);
    },
    components: {
        NewUserProfile,
        ButtonsManagement,
        PrimaryAlert,
    },
}
</script>

<style lang="scss">

.number-of-profiles {
    font-weight: 500;
    font-size: 13px;
    color: #ABB2C6;
    margin-bottom: 15px;
    margin-left: 30px;
    text-align: right;
}

.user-profile {
    margin-top: 40px;
    display: block;

    // btn
    &__button {
        margin-top: 25px;

        .btn {
            display: block;
            width: 295px;
            height: 44px;
        }
    }

}

@media screen and(min-width: 0px) {
    .btn {
        margin-right: auto;
        margin-left: auto;
    }
    .user-profile {
        &__img {
            text-align: center;
        }

        &__main-info {
            margin-top: 50px;
            text-align: center;
        }
    }
}

@media screen and(min-width: 768px) {
    .btn {
        margin-right: 0;
        margin-left: 0;
    }
    .user-profile {
        &__img {
            text-align: left;
        }

        &__main-info {
            margin-top: 0;
            text-align: left;
        }
    }
}

[v-cloak] {
    display: none;
}
</style>
