<template>
    <div class="col-12 float-left">
        <div class="user-profile__button">

            <div v-if="adding" class="button-active">
                <ButtonAccept
                    :text="textFirstButton"
                    @click.native="buttonActive('accepted')"
                ></ButtonAccept>

                <ButtonReject
                    :text="textSecondButton"
                    @click.native="buttonActive('rejected')"
                ></ButtonReject>

                <ButtonDelete
                    :text="textThirdButton"
                    @click.native="buttonActive('deleted')"
                ></ButtonDelete>
            </div>

            <div v-else>
                <ButtonAccept
                    :text="textFirstButton"
                    @click.native="buttonStatusEdit('accepted')"
                ></ButtonAccept>

                <ButtonReject
                    :text="textSecondButton"
                    @click.native="buttonStatusEdit('rejected')"
                ></ButtonReject>

                <ButtonDelete
                    :text="textThirdButton"
                    @click.native="buttonStatusEdit('deleted')"
                ></ButtonDelete>
            </div>

        </div>
    </div>
</template>

<script>
import ButtonAccept from "../Button/ButtonAccept"
import ButtonReject from "../Button/ButtonReject"
import ButtonDelete from "../Button/ButtonDelete"
import {addStoriesManager, updateStatusProfile} from "../../helper/profile";
import {updateStatus} from "../../helper/consideration";
import {mapActions} from 'vuex'

export default {
    name: "ButtonsManagement",
    data: () => ({
        request: {
            id: null,
            profile_id: 1,
            status_profile: null
        }
    }),
    props: {
        textFirstButton: {
            type: String,
            default: "NULL"
        },

        textSecondButton: {
            type: String,
            default: "NULL"
        },

        textThirdButton: {
            type: String,
            default: "NULL"
        },
        adding:{
            type: Boolean,
            default: true
        }
    },
    components: {
        ButtonAccept,
        ButtonReject,
        ButtonDelete,
    },
    mounted() {
    },
    methods: {
        ...mapActions([
            'ajaxFirstProfilerFromDB',
            'ajaxOneProfilerFromDB'
        ]),
        // Для добавления анкеты в историю текущего менеджера
        buttonActive(status_profile) {
            this.request.id = this.$store.state.currentUser.id
            this.request.profile_id = this.$store.getters.getFirstProfiler.id
            this.request.status_profile = status_profile
            // Добавление в историю текущего менеджера
            addStoriesManager(this.request)
            // Обновление статуса в DB всех профилей
            updateStatus(this.request)
            // Обновить компонент
            this.ajaxFirstProfilerFromDB()
        },
        // Поменять статус уже рассмотренной анкеты
        buttonStatusEdit(edit_status){
            this.request.id = this.$store.state.currentUser.id
            this.request.profile_id = this.$store.getters.getOneProfiler.id
            this.request.status_profile = edit_status

            // Обновление статуса в таблице Profiles
            updateStatus(this.request)
            // Обновление статуса в истории текущего менеджера
            updateStatusProfile(this.request)
            // Обновить компонент
            this.ajaxOneProfilerFromDB(this.request.profile_id)
        }
    }
}
</script>

<style scoped>

</style>
