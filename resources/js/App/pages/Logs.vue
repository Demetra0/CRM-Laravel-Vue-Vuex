<template>
    <div class="manager-history">
        <div class="container">
            <!--      Алерт об ошибке, если в бд нет профилей      -->
            <div v-if="checkAmount" style="text-align: center">
                <PrimaryAlert
                    :message="messageError"
                />
            </div>
            <!--    Спиннер    -->
            <div v-if="loading" style="text-align: center">
                <b-spinner
                    label="Loading..."
                    :variant="'primary'"
                    :key="'primary'"
                />
            </div>

            <div v-else>

                <Pagination
                    class="manager-history__users"
                    :data="getStoriesManager"
                    :total-pages="Math.ceil(getStoriesManager.length / perPage)"
                    :total="getStoriesManager.length"
                    :per-page="perPage"
                    :current-page="currentPage"
                    @pagechanged="onPageChange"
                />

            </div>
        </div>

        <div class="message-new-user">

            <b-alert
                class="message-registered"
                dismissible
                :show="showDismissibleAlert=true"
                @dismissed="showDismissibleAlert=false"
            >
                <span class="message-registered__text">New user registered!</span>
            </b-alert>

        </div>
    </div>
</template>

<script>
import Pagination from "../components/Pagination/Pagination";
import UsersLogs from "../components/UsersLogs/UsersLogs";
import {mapActions, mapGetters} from 'vuex'
import axios from "axios";
import PrimaryAlert from "../components/Alert/PrimaryAlert";

export default {
    name: "Logs",
    data: () => ({
        error: false,               // статус ошибки
        messageError: null,         // сообщение об ошибки
        loading: true,              // показывать спиннер во время загрузки
        profiles: [],               // история менеджера
        // пагинация
        perPage: 9,
        currentPage: 1,

    }),
    components: {
        UsersLogs,
        Pagination,
        PrimaryAlert
    },
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

        // Загружаем анкеты через Api
        this.ajaxStoriesManagerFromDB()
        this.loadProfile = false
    },
    computed: {
        rows() {
            return this.getStoriesManager.length
        },
        ...mapGetters([
            'getStoriesManager',
        ]),
        checkAmount() {
            const amount = this.getStoriesManager.length
            if (!amount) {
                this.error = true
                this.messageError = "Your story is empty now"
            } else {
                this.error = false
            }
            return !amount
        }
    },
    methods: {
        ...mapActions([
            'ajaxStoriesManagerFromDB'
        ]),
        onPageChange(page) {
            this.currentPage = page;
        },
    }
}
</script>

<style lang="scss">
$mainColor: #007AFF;

.manager-history {
    margin-top: 50px;
}

.message-new-user {
    position: absolute;
    top: 140px;
    right: 20px;
    height: 60px;
}

.message-registered {
    background: #E6F2FF !important;
    border-radius: 20px !important;
    border: none !important;
    vertical-align: middle;

    &__text {
        font-weight: 600;
        font-size: 15px;
        line-height: 20px;
        letter-spacing: -0.24px;
        color: $mainColor !important;
        padding: 20px 60px 20px 20px;
    }

    .close {
        margin-top: 3px;
        color: $mainColor !important;
        opacity: 1 !important;
        font-size: 17px !important;
    }
}

// Пагинация
.pagination {
    display: flex;
    justify-content: center;
    padding: 0;
    margin: 45px 100px 0 0;
    list-style-type: none;
}

.pagination-item {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    font-size: 8px !important;
    margin: 0 4px;

    button {
        margin: 0 !important;
        font-size: 0.95rem;
        font-weight: 600;
        border: none;
        border-radius: 25px;
        background: none;

        &:hover {
            color: $mainColor;
        }

        &.active {
            color: $mainColor;
        }
    }
}
</style>
